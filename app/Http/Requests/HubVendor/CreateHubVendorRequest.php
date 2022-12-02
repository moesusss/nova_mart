<?php

namespace App\Http\Requests\HubVendor;

use Illuminate\Foundation\Http\FormRequest;

class CreateHubVendorRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:hub_vendors,email',
            'phone'     => 'nullable|unique:hub_vendors,phone|regex:/^([0-9\s\-\+\(\)]*)$/|phone:MM',
            'password' => 'required|string|same:password_confirmation|min:6',
        ];
    }
}
