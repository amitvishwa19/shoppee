<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Http\Resources\OrderStatusResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'cart'=>unserialize($this->cart),
            'address'=>unserialize($this->address),
            'status'=>$this->status,
            'payment_id'=>$this->payment_id,
            'orderDate' =>  Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('D, M d, Y h:m A' ),
            'deliveryDate' =>  Carbon::createFromFormat('Y-m-d H:i:s', $this->deliveryDate)->format('D, M d, Y h:m A' ),
            'order_status' => OrderStatusResource::collection($this->order_status)
        ];
    }
}
