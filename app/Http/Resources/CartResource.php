<?php

namespace App\Http\Resources;

use App\Models\Post;
use App\Models\Product;
use App\Http\Resources\Grocery\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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

        return[
            'cart_id' => $this->id,
            //'product' =>Post::where('id',$this->post_id)->get(),
            'product' =>new ProductResource(Product::findOrFail($this->product_id)),
            'quantity' => $this->quantity
        ];
    }
}
