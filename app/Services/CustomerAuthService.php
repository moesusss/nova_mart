<?php

namespace App\Services;

use App\Services\CustomerService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CustomerAuth\OTPRequest;
use App\Repositories\CheckSMSVerifyLogRepository;
use App\Services\Interfaces\CustomerAuthServiceInterface;
use App\Http\Resources\V1\CustomerAuth\OTPRequestCollection;
use App\Models\CustomerAddress;
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
        return $sms_data;
        
    }

    public function VerifyOTP(array $data)
    {
        $result=true;
        // $result = $this->smsService->verify($data['request_id'], $data['otp_code']);
        $response['status'] = false;
        if($result){
            if($data['is_login']==1){
                $customer = $this->checkMemberValid($data['mobile']);
                if($customer && $customer->is_active==1){
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

    public function add_address(array $data){       
        $data['customer_id']= auth()->user()->id;
        $address = $this->addressRepository->create($data);
        $customer_addresses = $this->addressRepository->getCustomerAddressesByCustomerID(auth()->user()->id);
        return $customer_addresses;
    }

    public function destroy($data){ 
        $customer_address = $this->addressRepository->getCustomerAddress($data['id']);
        $address = $this->addressRepository->destroy($customer_address);
        return $address;
    }

    public function checkAddress($data){
        $customer_id = auth()->user()->id;
        $customeraddress = $this->addressRepository->getCustomerAddressesByCustomerID($customer_id);
        // dd(count($customeraddress));
        foreach($customeraddress as $add){
            $distance = $this->getDistanceBetweenPointsNew($add->lat,$add->lng,$data['lat'],$data['lng']);
            if($distance == 0){
                return $this->addressRepository->getCustomerAddress($add->id);
            }
        }
        return false;
    }

    public function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'km') {
        $theta = $longitude1 - $longitude2; 
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
        $distance = acos($distance); 
        $distance = rad2deg($distance); 
        $distance = $distance * 60 * 1.1515; 
        switch($unit) { 
          case 'miles': 
            break; 
          case 'kilometers' : 
            $distance = $distance * 1.609344; 
        } 
        return (round($distance,2)); 
    }
}

?>