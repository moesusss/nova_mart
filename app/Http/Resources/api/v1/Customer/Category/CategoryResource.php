<?php

namespace App\Http\Resources\api\v1\Customer\Category;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\api\v1\Customer\MainService\MainServiceResource;
use App\Http\Resources\api\v1\Customer\SubCategory\SubCategoryCollection;

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
        $cover_image = Storage::disk('public')->exists('categories/' . $this->cover_image);
        if ($cover_image) {
            $cover_image = $this->cover_image ? asset('storage/categories/'.$this->cover_image):null;
            // $path = public_path().'/vendors/'.$this->cover_image;
            // $cover_image = Response::download($path);   

            // Storage::url('vendors/' . $this->cover_image) : null;
        }else{
            $cover_image = null;
        }
        return [
            'id'            => $this->id,
            'code'           => $this->code,
            'name'           => $this->name,
            'mm_name'           => $this->mm_name,
            'is_active'           => $this->is_active,
            'main_service_id'           => $this->main_service_id,
            'cover_image'           => $cover_image,
            'main_service' => MainServiceResource::make($this->whenLoaded('main_service')),
            'sub_categories' => SubCategoryCollection::make($this->whenLoaded('sub_categories')),
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
