<?php

namespace App\Services;

use App\Services\CustomerService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CustomerAuth\OTPRequest;
use App\Repositories\CheckSMSVerifyLogRepository;
use App\Services\Interfaces\CustomerAuthServiceInterface;
use App\Http\Resources\V1\CustomerAuth\OTPRequestCollection;
use App\Repositories\api\v1\Customer\CustomerAuthRepository;
use App\Repositories\api\v1\Customer\CustomerAddressRepository;

class CustomerAuthService implements CustomerAuthServiceInterface
{
    protected $authRepository;
    protected $userService;
    protected $smsService;
    protected $checksmslogRepository;
    protected $addressRepository;
    

    public function __construct(CustomerAuthRepository $authRepository, CustomerService $customerService,SMSService $smsService,CheckSMSVerifyLogRepository $checksmslogRepository,CustomerAddressRepository $addressRepository)
    {
        $this->authRepository = $authRepository;
        $this->customerService = $customerService;
        $this->smsService = $smsService;
        $this->checksmslogRepository = $checksmslogRepository;
        $this->addressRepository = $addressRepository;
    }

    public function create(array $data){       
        $customer = $this->authRepository->create($data); 
        $data['customer_id']= $customer->id; 
        $address = $this->addressRepository->create($data);
        $token = $this->login($customer);
        $response['status'] = true;
        $response['token'] = $token;
        $response['data'] = $customer->refresh();
        return $response;
    }

    public function requestOTP(array $data){
        // $reqID = 0;
       
        $sms_data = $this->smsService->verifyRequest($data['mobile']);  
        if($sms_data){
            $sms_logs = $this->checksmslogRepository->create($sms_data); 
            // $check_sms_log = $this->checksmslogService->getCheckSMSVerifyLog($sms_logs->id);
            return $sms_logs->id;
        }
    }

    public function VerifyOTP(array $data)
    {
        // $result=true;
        $response['status'] = false;
        $result = $this->smsService->verify($data['request_id'], $data['otp_code']);
        if($result){
            if($data['is_login']==1){
                $customer = $this->checkMemberValid($data['mobile']);
                if($customer){
                    $token = $this->login($customer);
                    $data['customer_id']= $customer->id;
                    $response['status'] = true;
                    $response['token'] = $token;
                    $response['data'] = $customer->refresh();
                    $response['sms_result'] = $result;
                    return $response;
                }else{
                    $response['status'] = false;
                }
                
                $response['status'] = true;
            }else{
                $response['status'] = true;
            }
        }
        
        
        return $response;   
    }

    public function login($customer){   
        
        Auth::guard('customer')->setUser($customer);
      
        // return $accessToken;
        $accessToken = Auth::guard('customer')->user()->createToken('authToken')->accessToken;
        return $accessToken;
        
    }

    public function checkMemberValid($mobile){
        if(is_numeric($mobile))
        {
            $data = $this->authRepository->checkField('mobile',$mobile);
        }
        
        return $data;
    }

    public function updateProfile($request){
        if(is_numeric($request['verify']))
        {
            $request['phone'] = $request['verify'];            
        }
        else {
            $request['email'] = $request['verify'];
        }
        $user = $this->authRepository->update(auth()->user(),$request);
        return $user;
    }

    public function updatePassword($user,$password){
        $user = $this->authRepository->update_password($user,$password);
        return $user;
    }
}

?>