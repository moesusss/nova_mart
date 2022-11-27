<?php

namespace App\Http\Resources\api\v1\Customer\Profile;

use App\Http\Resources\api\v1\CustomerAddress\CustomerAddressCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            'mobile'        => $this->mobile,
            'is_active'     => $this->is_active,
            'addresses'     => CustomerAddressCollection::make($this->whenLoaded('customer_addresses'))
        ];
    }
}
