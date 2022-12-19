<?php

namespace App\Http\Resources\api\v1\Customer\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\api\v1\Customer\Vendor\VendorResource;
use App\Http\Resources\api\v1\Customer\OrderItem\OrderItemCollection;
use App\Http\Resources\api\v1\Customer\CustomerAddress\CustomerAddressResource;

class OrderResource extends JsonResource
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
            'transaction_id' => $this->transaction_id,
            'transaction_ref' => $this->transaction_ref,
            'vendor_id' => $this->vendor_id,
            'customer_id' => $this->customer_id,
            'customer_address_id' => $this->customer_address_id,
            'is_coupon' => $this->is_coupon,
            'total_discount_amount' => $this->total_discount_amount,
            'delivery_id' => $this->delivery_id,
            'delivery_amount' => $this->delivery_amount,
            'tax_amount' => $this->tax_amount,
            'sub_total' => $this->sub_total,
            'grand_total' => $this->grand_total,
            'vendor' => VendorResource::make($this->whenLoaded('vendor')),
            'order_items' => OrderItemCollection::make($this->whenLoaded('order_items')),
            
           
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
