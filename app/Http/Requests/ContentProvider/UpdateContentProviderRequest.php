<?php

namespace App\Http\Requests\ContentProvider;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContentProviderRequest extends FormRequest
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
            'name' => 'required|string|unique:content_providers,name,'. $this->route('content_provider')->id,
            'rev_share' => 'required|regex:/^\d{1,14}(\.\d{1,2})?$/',
            'signed_date' => 'required|date_format:Y-m-d,' . date('m/d/Y'),
            'phone' => 'nullable|string|unique:content_providers,phone,'. $this->route('content_provider')->id,
            'address' => 'nullable|string',
            'email' => 'nullable|string|unique:content_providers,email,'. $this->route('content_provider')->id,
            'password' => 'nullable|string|confirmed|min:6',
        ];
    }
}
