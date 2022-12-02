<?php

namespace App\Http\Requests\HubVendor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHubVendorRequest extends FormRequest
{
    /**
     * Determine if the hub vendor is authorized to make this request.
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
            'name' => 'required',
            'email' => 'required|email|unique:hub_vendors,email,'.$this->route('hub_vendor')->id,
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|phone:MM|unique:hub_vendors,mobile,'.$this->route('hub_vendor')->id,
            'password' => 'same:password_confirmation'
        ];
    }
}
