<?php

namespace App\Http\Resources\api\v1\CustomerAddress;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerAddressResource extends JsonResource
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
            'id'                        => $this->id,
            'customer_id'               => $this->customer_id,
            'city_id'                   => $this->city_id,
            'city_name'                 => $this->city_name,
            'address'                   => $this->address,
            'lat'                       => $this->lat,
            'lng'                       => $this->lng,
            'delivery_instructions'     => $this->delivery_instructions,
            'is_delivery_available'     => $this->is_delivery_available,
        
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
