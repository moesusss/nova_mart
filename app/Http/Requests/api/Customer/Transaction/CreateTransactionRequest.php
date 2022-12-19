<?php

namespace App\Http\Requests\api\Customer\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
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
            'customer_id' => 'required|uuid|exists:customers,id',
            'customer_address_id' => 'required|uuid|exists:customer_addresses,id',
            'is_coupon' => 'nullable|boolean',
            'coupon_code' => 'nullable|string',
            'payment_method_id' => 'required|uuid|exists:payment_methods,id',
            'description' => 'nullable|string',
            'tax_amount' => 'nullable|regex:/^\d{1,14}(\.\d{1,2})?$/',
            
            'orders' => 'required|array',
            'orders.*.vendor_id'  =>  'required|uuid|exists:vendors,id',
            'orders.*.is_coupon'  =>  'nullable|boolean',
            'orders.*.delivery_amount' =>  'required|regex:/^\d{1,14}(\.\d{1,2})?$/',
            'orders.*.tax_amount'  =>  'nullable|regex:/^\d{1,14}(\.\d{1,2})?$/',

            'orders.*.order_items' => 'required|array',
            'orders.*.order_items.*.item_id'  =>  'required|uuid|exists:items,id',
            'orders.*.order_items.*.is_promotion'     =>  'nullable|boolean',
            'orders.*.order_items.*.qty'     =>  'required|regex:/^\d{1,14}(\.\d{1,2})?$/',
            'orders.*.order_items.*.price'     =>  'required|regex:/^\d{1,14}(\.\d{1,2})?$/',
            'orders.*.order_items.*.discount_amount'     => 'nullable|regex:/^\d{1,14}(\.\d{1,2})?$/',
        ];
    }
}