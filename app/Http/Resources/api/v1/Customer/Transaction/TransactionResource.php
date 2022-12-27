<?php

namespace App\Http\Resources\api\v1\Customer\Transaction;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\api\v1\Customer\Order\OrderCollection;
use App\Http\Resources\api\v1\Customer\CustomerAddress\CustomerAddressResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'transaction_ref'  => $this->transaction_ref,
            'customer_id'  => $this->customer_id,
            'customer_address_id'  => $this->customer_address_id,
            'customer_address' => CustomerAddressResource::make($this->whenLoaded('customer_address')),
            'is_coupon'  => $this->is_coupon,
            'coupon_code'  => $this->coupon_code,
            'total_discount_amount'  => $this->total_discount_amount,
            'total_delivery_amount'  => $this->total_delivery_amount,
            'sub_total'  => $this->sub_total,
            'grand_total'  => $this->grand_total,
            'transaction_date'  => $this->transaction_date,
            'payment_method_id'  => $this->payment_method_id,
            'payment_ref'  => $this->payment_ref,
            'payment_status'  => $this->payment_status,
            'description'  => $this->description,
            'tax_amount'  => $this->tax_amount,
            'orders' => OrderCollection::make($this->whenLoaded('orders')),
            
           
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'status' => true,
        ];
    }
}
