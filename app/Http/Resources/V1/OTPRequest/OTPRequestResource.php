<?php

namespace App\Http\Resources\V1\OTPRequest;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OTPRequestResource extends ResourceCollection
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
            'id'            => $this->first()->id,
            'request_id'    => $this->first()->request_id,
            'mobile'        => $this->first()->to,
            'expired_at'    => \Carbon\Carbon::parse($this->first()->sms_created_at)->addMinutes(1)->format('Y-m-d H:i:s')
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
