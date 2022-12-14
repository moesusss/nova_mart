<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class CreateVendorRequest extends FormRequest
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
            'email'  => 'nullable|string|unique:vendors,email',
            'username' => 'nullable|string|unique:vendors,username',
            'mobile' => 'required|numeric|phone:MM|unique:vendors,mobile',
            'password' => 'nullable|string|same:password_confirmation|min:6',
            'hub_vendor_id' => 'required|uuid|exists:hub_vendors,id',
            'address' => 'nullable|string',
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
