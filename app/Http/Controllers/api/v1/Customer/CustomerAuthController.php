<?php

namespace App\Http\Controllers\Api\v1\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\CustomerAuthService;
use App\Services\CheckSMSVerifyLogService;
use App\Http\Requests\api\Customer\Otp\OTPRequest;
use App\Http\Requests\api\Customer\Otp\OTPVerifyRequest;
use App\Http\Requests\CustomerAuth\CustomerLoginRequest;
use App\Http\Requests\api\Customer\Auth\AddAddressRequest;
use App\Http\Resources\api\v1\OTPRequest\OTPRequestResource;
use App\Http\Requests\api\Customer\Auth\UpdateProfileRequest;
use App\Http\Resources\api\v1\Customer\Profile\ProfileResource;
use App\Http\Requests\api\Customer\Auth\CustomerRegisterRequest;
use App\Http\Resources\api\v1\CustomerAddress\CustomerAddressResource;
use App\Http\Resources\api\v1\CustomerAddress\CustomerAddressCollection;

class CustomerAuthController extends Controller
{

    protected $customerAuth;
    protected $checksmslogService;

    public function __construct(CustomerAuthService $customerAuth,CheckSMSVerifyLogService $checksmslogService)
    {
        $this->customerAuth= $customerAuth;
        $this->checksmslogService= $checksmslogService;
    }

    //  Customer Login Function 
    public function login(Request $request){;
    }

    // Request OTP for login or register
    public function otpRequest(OTPRequest $request){
        if($request->is_login=='1'){
            $customer = $this->customerAuth->checkMemberValid($request->mobile);
            if($customer){
                $valid_verify=true;
            }else{
                $valid_verify=false;
                return response()->json(['status'=>false,'message'=>'Account does not exist. Please register to login.'],Response::HTTP_OK);
            }
        }else{
            $customer = $this->customerAuth->checkMemberValid($request->mobile);
            if($customer){
                $valid_verify=false;
                return response()->json(['status'=>false,'message'=>'Mobile number already use'],Response::HTTP_OK);
            }else{
                $valid_verify=true;
            }
        }
        if($valid_verify){
            $result = $this->customerAuth->requestOTP($request->all());
            if($result){
                $check_sms_log = $this->checksmslogService->getCheckSMSVerifyLog($result);
          
                return new OTPRequestResource($check_sms_log);
            }else{
                return response()->json(['status'=>false,'message'=>'OTP request failed!'],Response::HTTP_OK);
            }
            
        }
       
    }

    // Verify OTP for login or register
    public function otpVerify(OTPVerifyRequest $request){
        $result = $this->customerAuth->verifyOTP($request->all());
        if($request->is_login=='1'){
            if($result){
                if(!$result['status'])
                {
                    return response()->json(['status'=>false,'message'=>'Your login is failed!'],Response::HTTP_OK);
                }else{
                    return response()->json([
                        'status'=>true,
                        'message'=>'Success',
                        'token'=> $result['token'],
                        'data' => new ProfileResource($result['data']->load(['customer_addresses']))
                    
                    ],Response::HTTP_OK);
                }
            }else{
                return response()->json(['status'=>false,'message'=>'Your login is failed!'],Response::HTTP_OK);
            }
        }else{
            if(!$result['status'])
            {
                return response()->json(['status'=>false,'message'=>'OTP Verify process is failed!'],Response::HTTP_OK);
            }

            return response(['status'=>true,'message'=>'OTP Verify process success','data'=>null]);
        }
        
    }

    //  Customer Register Function
    public function register(CustomerRegisterRequest $request){
        $result = $this->customerAuth->create($request->all());

        
        if(!$result['status'])
        {
            return response()->json(['status'=>false,'message'=>'Your registration is failed!'],Response::HTTP_OK);
        }else{
            return response()->json([
                'status'=>true,
                'message'=>'Success',
                'token'=> $result['token'],
                'data' => new ProfileResource($result['data']->load(['customer_addresses']))
            
            ],Response::HTTP_OK);
        }
    }

    public function update_profile(UpdateProfileRequest $request)
    {
        $user = auth()->user();

        $user = $request->updateProfile($user);

        return new ProfileResource($user);
        // return response()->json(['status' => 1, 'message' => 'Successfully updated!'], Response::HTTP_OK);
    }

    public function add_address(AddAddressRequest $request)
    {
        $result = $this->customerAuth->add_address($request->all());

        return new CustomerAddressResource($result);
        // return response()->json(['status' => 1, 'message' => 'Successfully updated!'], Response::HTTP_OK);
    }
    
}
