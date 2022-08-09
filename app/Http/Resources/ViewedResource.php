<?php

namespace App\Http\Resources;

use App\Models\Post;
use App\Models\Product;
use App\Http\Resources\Grocery\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ViewedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return new ProductResource(Product::findOrFail($this->product_id));
    }
}
