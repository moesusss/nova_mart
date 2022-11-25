<?php

namespace App\Services;

use App\Services\CustomerService;
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
        $success['token'] =  $customer->createToken('MyApp')->accessToken;
        dd($success['token']);
        $data['customer_id']= $customer->id;
        $address = $this->addressRepository->create($data);
        return $customer;
    }

    public function requestOTP(array $data){
        // $reqID = 0;
        $sms_data = [ // app/Services/SMSService.php:42
            "channel" => "SMS",
            "status" => true,
            "request_id" => 988575,
            "to" => "09420118185",
            "created_at" => "2022-11-24 08:15:56",
            "expire_at" => "2022-11-24 01:50:56"
        ];
       
        // $sms_data = $this->smsService->verifyRequest($data['mobile']);  
        if($sms_data){
            $sms_logs = $this->checksmslogRepository->create($sms_data); 
            // $check_sms_log = $this->checksmslogService->getCheckSMSVerifyLog($sms_logs->id);
            return $sms_logs->id;
        }
        
        // $user["sms_request_id"] = $reqID;
        // session()->put('sms_request_id',$reqID);
    }

    public function verifyAccount($token)
    {
        // $user = $this->authRepository->checkField('email_verification_token',$token);
        // if($user == null ){
        //     return null;
        // }
        // $verify_user = $this->authRepository->verifyAccount($user);
        // return $verify_user;
    }

    public function VerifyOTP(array $data)
    {
        $user = $this->checkMemberValid($data['mobile']);
        $result = $this->smsService->verify($data['request_id'], $data['otp_code']);
        
    }

    public function login($request){        
        // $user = $this->checkMemberValid($request->verify);
        // if(!$user)
        // {
        //     return null;
        // }

        // $loginData = [
        //     'email' => $request->verify,
        //     'password' => $request->password,
        //     'is_verified' => 1,
        // ];

        // if(is_numeric($request->verify))
        // {
        //     $loginData = [
        //         'phone' => $request->verify,
        //         'password' => $request->password,
        //         'is_verified' => 1,
        //     ];
        // }

        // if (auth()->attempt($loginData)) {
        //     $accessToken = auth()->user()->createToken('authToken')->accessToken;   
        // }else{
        //     return response()->json(['status'=>false,'message'=>'Invalid Credentials']);
        // }
        
        // return $accessToken;
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