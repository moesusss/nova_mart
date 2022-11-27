<?php

namespace App\Http\Requests\api\Customer\Otp;

use Illuminate\Foundation\Http\FormRequest;

class OTPVerifyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'request_id' => 'required',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|phone:MM',
            'otp_code'   => 'required',
            'is_login'   => 'required'
        ];
    }
}
