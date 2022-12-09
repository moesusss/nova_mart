<?php

namespace App\Http\Resources\api\v1\Customer\Vendor;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\api\v1\Customer\MainService\MainServiceResource;
use Illuminate\Support\Facades\Response;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $cover_image = Storage::disk('public')->exists('vendors/' . $this->cover_image);

        if ($cover_image) {
            $cover_image = $this->cover_image ? asset('storage/vendors/'.$this->cover_image):null;
            // $path = public_path().'/vendors/'.$this->cover_image;
            // $cover_image = Response::download($path);   

            // Storage::url('vendors/' . $this->cover_image) : null;
        }
        return [
            'id'   => $this->id,
            'name' => $this->name,
            'mm_name' => $this->mm_name,
            'email' => $this->email,
            'username' => $this->username,
            'mobile' => $this->mobile,
            'main_service_id' => $this->main_service_id,
            'main_service' => MainServiceResource::make($this->whenLoaded('main_service')),
            'hub_vendor_id' => $this->hub_vendor_id,
            'address' => $this->address,
            'opening_time' => $this->opening_time,
            'closing_time' => $this->closing_time,
            'is_active' => $this->is_active,
            'is_closed' => $this->is_closed,
            'cover_image' => ($cover_image)?$cover_image:null,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'min_order_time' => $this->min_order_time,
            'min_order_amount' => $this->min_order_amount,
            
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
