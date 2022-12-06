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
            'mm_name' => 'string|max:255',
            'email'  => 'nullable|string|unique:vendors,email',
            'username' => 'nullable|string|unique:vendors,username',
            'mobile' => 'required|numeric|phone:MM|unique:vendors,mobile',
            'password' => 'nullable|string|same:password_confirmation|min:6',
            'hub_vendor_id' => 'required|uuid|exists:hub_vendors,id',
            'address' => 'required|string',
            'opening_time' => 'required|date_format:h:i A',
            'closing_time' => 'required|after_or_equal:opening_time|date_format:h:i A',
            'is_active' => 'nullable|boolean',
            'is_closed' => 'nullable|boolean',
            'lat' => 'required',
            'lng' => 'required',
            'min_order_time' => 'required',
            'min_order_amount' => 'required',
        ];
    }
}
