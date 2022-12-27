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
            'mm_name' => 'nullable|string|max:255',
            'email'  => 'nullable|string|unique:vendors,email,'.$this->route('vendor')->id,
            'username' => 'nullable|string|unique:vendors,username,'.$this->route('vendor')->id,
            'mobile' => 'required|numeric|phone:MM|unique:vendors,mobile,'.$this->route('vendor')->id,
            'password' => 'nullable|string|same:password_confirmation|min:6',
            'hub_vendor_id' => 'required|uuid|exists:hub_vendors,id',
            'address' => 'required|string',
            'opening_time' => 'required',
            'closing_time' => 'required|after_or_equal:opening_time',
            'order_closing_time' => 'required|before_or_equal:closing_time|after_or_equal:opening_time',
            'is_active' => 'nullable|boolean',
            'is_closed' => 'nullable|boolean',
            'lat' => 'required',
            'lng' => 'required',
            'min_order_time' => 'required',
            'min_order_amount' => 'required',
            'commission_fee' => 'required',
        ];
    }
}
