<?php

namespace App\Http\Resources\api\v1\Customer\Category;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\api\v1\Customer\MainService\MainServiceResource;

class CategoryResource extends JsonResource
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
            'main_service_id'           => $this->main_service_id,
            'main_service' => MainServiceResource::make($this->whenLoaded('main_service')),
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
