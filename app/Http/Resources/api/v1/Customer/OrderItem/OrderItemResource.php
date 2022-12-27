<?php

namespace App\Http\Resources\api\v1\Customer\OrderItem;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\api\v1\Customer\Item\ItemResource;
use App\Http\Resources\api\v1\Customer\Vendor\VendorResource;
use App\Http\Resources\api\v1\Customer\CustomerAddress\CustomerAddressResource;

class OrderItemResource extends JsonResource
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
            'order_id' => $this->order_id,
            'transaction_id' => $this->transaction_id,
            'item_id' => $this->item_id,
            'qty' => $this->qty,
            'price' => $this->price,
            'total' => $this->total,
            'is_promotion' => $this->is_promotion,
            'discount_amount' => $this->discount_amount,
            'description' => $this->description,
            'item' => ItemResource::make($this->whenLoaded('item')),
           
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
