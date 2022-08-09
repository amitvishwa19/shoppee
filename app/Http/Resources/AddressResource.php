<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'id' => $this->id,
            'house' => $this->house,
            'locality' => $this->locality,
            'landmark' => $this->landmark,
            'optional' => $this->optional,
            'city' => $this->city,
            'state' => $this->state,
            'pincode' => $this->pincode,
            'mobile' => $this->mobile,
            'type' => $this->type,
            'selected' => $this->default
        ];
    }
}
