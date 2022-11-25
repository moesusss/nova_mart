<?php

namespace App\Http\Controllers\Api\v1\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\CustomerAuthService;
use App\Services\CheckSMSVerifyLogService;
use App\Http\Requests\api\Customer\Otp\OTPRequest;
use App\Http\Requests\api\Customer\Otp\OTPVerifyRequest;
use App\Http\Requests\CustomerAuth\CustomerLoginRequest;
use App\Http\Resources\V1\OTPRequest\OTPRequestResource;
use App\Http\Requests\api\Customer\Auth\CustomerRegisterRequest;

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
    public function login(Request $request){
        $customer = Customer::where('mobile', $request['mobile'])->firstOrFail();
        // if (auth()->attempt($request->all())) {
        //     return response([
        //         'user' => auth()->user(),
        //         'access_token' => auth()->user()->createToken('authToken')->accessToken
        //     ], Response::HTTP_OK);
        // }
        $loginData = [
            
            'mobile' => $request['mobile'],
            'is_active' => 1,
        ];
        Auth::guard('customer')->check($customer);
        dd(Auth::guard('customer')->check($customer));
        // $token = auth()->createToken('authToken')->accessToken;
        // dd($token);
        // if (auth()->guard('customer')->attempt($loginData)) {
        //     $accessToken = auth()->guard('customer')->createToken('authToken')->accessToken;   
        // }else{
        //     return response()->json(['status'=>false,'message'=>'Invalid Credentials']);
        // }
        
        // return $accessToken;
        // Auth::guard('customer')->attempt($customer);
        //     $accessToken = Auth::guard('customer')->user()->createToken('authToken')->accessToken;
        //     return response()->json([
        //         'status' => 1,
        //         'message' => 'Success',
        //         'access_token' => $accessToken,
        //         'data' => $customer
        //         // 'user' => new AgentResource($agent->load([
        //         //                             'region','district','township','city','zone','ward','account',
        //         //                             'created_by','updated_by','bank_informations','bank_informations.bank'
        //         //                         ])),
        //     ], 200);
    }

    // Request OTP for login or register
    public function otpRequest(OTPRequest $request){
        $result = $this->customerAuth->requestOTP($request->all());
        $check_sms_log = $this->checksmslogService->getCheckSMSVerifyLog($result);
        return new OTPRequestResource($check_sms_log);
    }

    // Verify OTP for login or register
    public function otpVerify(OTPVerifyRequest $request){
        $result = $this->customerAuth->verifyOTP($request->all());
    }

    //  Customer Register Function
    public function register(CustomerRegisterRequest $request){
        $result = $this->customerAuth->create($request->all());

        
        if(!isset($result))
        {
            return response()->json(['status'=>false,'message'=>'Your registration is failed!'],Response::HTTP_OK);
        }
    }
}
