<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorRequest extends FormRequest
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
            'name'      => 'required|string|max:255',
            'mm_name' => 'required|string|max:255',
            'email'  => 'required|string|unique:vendors,email,'.$this->route('vendor')->id,
            'username' => 'required|string|unique:vendors,username,'.$this->route('vendor')->id,
            'mobile' => 'nullable|numeric|phone:MM|unique:vendors,phone,'.$this->route('vendor')->id,
            'password' => 'nullable|string|same:password_confirmation|min:6',
            'main_service_id' => 'required|uuid|exists:main_services,id',
            'hub_vendor_id' => 'required|uuid|exists:hub_vendors,id',
            'address' => 'required|string',
            'opening_time' => 'required|date|date_format:H:i A',
            'closing_time' => 'required|date|after_or_equal:opening_time|date_format:H:i A',
            'is_active' => 'nullable|boolean',
            'is_closed' => 'nullable|boolean',
            'lat' => 'required|regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/',
            'lng' => 'required|regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/',
            'min_order_time' => 'nullable|date|date_format:H:i',
        ];
    }
}
