<?php

namespace App\Http\Resources\api\v1\Customer\Item;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\api\v1\Customer\MainService\MainServiceResource;
use Illuminate\Support\Facades\Response;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $cover_image = Storage::disk('public')->exists('vendors/' . $this->cover_image);
        // if ($cover_image) {
        //     $cover_image = $this->cover_image ? asset('storage/vendors/'.$this->cover_image):null;
        //     // $path = public_path().'/vendors/'.$this->cover_image;
        //     // $cover_image = Response::download($path);   

        //     // Storage::url('vendors/' . $this->cover_image) : null;
        // }
        return [
            'id'   => $this->id,
            'name' => $this->name,
            'mm_name' => $this->mm_name,
            'vendor_id' => $this->vendor_id,
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,
            'brand_id' => $this->brand_id,
            'sku' => $this->sku,
            'barcode' => $this->barcode,
            'qty' => $this->qty,
            'price' => $this->price,
            'weight' => $this->weight,
            'is_active' => $this->is_active,
            'is_instock' => $this->is_instock,
            'is_package' => $this->is_package,
            'description' => $this->description,
            'item_type' => $this->item_type,
            'unit_type' => $this->unit_type,
            
            
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