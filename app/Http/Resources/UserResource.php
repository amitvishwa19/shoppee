<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'firstname'=>$this->firstName,
            'lastname'=>$this->lastName,
            'username'=>$this->username,
            'email'=>$this->email,
            'avatar'=>$this->avatar_url,
            'type'=>$this->type,
            'role'=>$this->role,
        ];
    }
}
