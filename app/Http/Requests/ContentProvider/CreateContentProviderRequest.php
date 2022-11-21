<?php

namespace App\Http\Requests\ContentProvider;

use Illuminate\Foundation\Http\FormRequest;

class CreateContentProviderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:content_providers,name',
            'rev_share' => 'required|regex:/^\d{1,14}(\.\d{1,2})?$/',
            'signed_date' => 'required|date_format:Y-m-d',
            'phone' => 'nullable|numeric|unique:content_providers,phone',
            'address' => 'nullable|string',
            'email' => 'nullable|string|unique:content_providers,email',
            'password' => 'nullable|string|confirmed|min:6',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // 'name.required' => 'name is required',
            'rev_share.required' => 'Revenue share is required',
            'signed_date.required' => 'Singing date is required',
            'phone.required' => 'Phone no is required',
        ];
    }
}
