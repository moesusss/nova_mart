<?php

namespace App\Http\Resources\api\v1\Customer\SubCategory;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\api\v1\Customer\Category\CategoryResource;

class SubCategoryResource extends JsonResource
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
            'category_id'           => $this->category_id,
            'category' => CategoryResource::make($this->whenLoaded('category')),
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
