<?php

namespace App\Http\Resources\api\v1\Customer\Brand;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\api\v1\Customer\SubCategory\SubCategoryResource;

class BrandResource extends JsonResource
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
            'code'           => $this->code,
            'name'           => $this->name,
            'mm_name'           => $this->mm_name,
            'is_active'           => $this->is_active,
            'sub_category_id'           => $this->sub_category_id,
            'sub_category' => SubCategoryResource::make($this->whenLoaded('sub_category')),
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
