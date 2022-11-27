<?php
 
namespace App\Services;

use App\Services\Interfaces\ISMSService;
use Exception;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\StreamHandler;

class SMSService implements ISMSService
{
    private $key = '';
    private $baseURL = '';
    private $verifyRequestURL = '';
    private $verifyURL = '';

    public function __construct()
    {   
        $this->key = config('services.sms.key');
        $this->baseURL = config('services.sms.base_url');
        $this->verifyRequestURL = config('services.sms.verify_url') . config('services.sms.verify_request');
        $this->verifyURL = config('services.sms.verify_url') . config('services.sms.verify');
        $this->sendURL = config('services.sms.base_url') . config('services.sms.send_api');
    }

    public function verifyRequest($phone)
    { 
        try {            
            $response = Http::get($this->verifyRequestURL, [
                'access-token' => $this->key,
                'to' => $phone,
                'code_length'=>6,
                'brand_name' => config('app.name')
            ]);

            if($response->ok())
            {
                $respBody = $response->json();
                return $respBody;
            }
        }
        catch(RequestException $exc)
        {
            Log::error($exc->getMessage());
            throw new Exception('Unable to send verification code');
        }

        return 0;
    }
    

    public function verify($request_id, $code)
    {
        $response = Http::get($this->verifyURL, [
            'access-token' => $this->key,
            'request_id' => $request_id,
            'code' => $code
        ]);

        if($response->ok())
        {
            return $response['status'];
        }
        
        return false;
    }

    public function resetPasswordRequest($phone,$password)
    {    
        try { 
            $data = [
                'to' => $phone,
                'message' => 'You password has been changed. Kindly use '. $password.' for new password. Please do not forget to change.'
            ];
            $ch = curl_init($this->sendURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $this->key,
                'Content-Type: application/json'
            ]); 
            $result = curl_exec($ch);
        }
        catch(RequestException $exc)
        {
            Log::error($exc->getMessage());
            throw new Exception('Unable to send verification code');
        }

        return 0;
    }
}