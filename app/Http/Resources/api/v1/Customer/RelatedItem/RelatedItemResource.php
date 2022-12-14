<?php

namespace App\Http\Resources\api\v1\Customer\RelatedItem;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\api\v1\Customer\Image\ImageCollection;

class RelatedItemResource extends JsonResource
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
            'id'   => $this->id,
            'name' => $this->name,
            'mm_name' => $this->mm_name,
            'vendor_id' => $this->vendor_id,
            'vendor_name' => optional($this->vendor)->name,
            'category_id' => $this->category_id,
            'category_name' => optional($this->category)->name,
            'sub_category_id' => $this->sub_category_id,
            'sub_category_name' => optional($this->sub_category)->name,
            'brand_id' => $this->brand_id,
            'brand_name' => optional($this->brand)->name,
            'price' => $this->price,
            'weight' => $this->weight,
            'is_active' => $this->is_active,
            'is_instock' => $this->is_instock,
            'is_package' => $this->is_package,
            'description' => $this->description,
            'item_type' => $this->item_type,
            'unit_type' => $this->unit_type,
            'images' => ImageCollection::make($this->whenLoaded('images')),
            
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
