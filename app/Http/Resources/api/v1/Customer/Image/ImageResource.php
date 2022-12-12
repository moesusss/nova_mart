<?php

namespace App\Http\Resources\api\v1\Customer\Image;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\api\v1\Customer\MainService\MainServiceResource;
use Illuminate\Support\Facades\Response;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $cover_image = Storage::disk('public')->exists('items/' . $this->image_url);
        // if ($cover_image) {
        //     $cover_image = $this->image_url ? asset('storage/items/'.$this->image_url):null;
        // }
        return [
            'id'   => $this->id,
            'resourceable_type'   => $this->resourceable_type,
            'resourceable_id' => $this->resourceable_id,
            'image_url' => ($this->image_url)?asset('storage/items/'.$this->image_url):null,
            'is_default' => $this->is_default,
            
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
