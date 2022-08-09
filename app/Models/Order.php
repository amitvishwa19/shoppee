<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user()
    {
        //return $this->belongsTo('App\Models\Tag');
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function order_status()
    {
        return $this->hasMany('App\Models\OrderStatus')->orderBy('created_at','asc');
    }

}
