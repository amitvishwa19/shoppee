<?php

namespace App\Http\Resources\Grocery;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'image' => $this->feature_image,
            'price' => $this->price,
            'discount' => $this->discount,
            'netPrice' => intval(number_format($this->price -($this->price * $this->discount)/100,0)),
            'sku' => $this->sku,
            'featured' => $this->featured,
            'rating' => $this->rating,
            'quantity' => $this->quantity
          
        ];
    }
}
