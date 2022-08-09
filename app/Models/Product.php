<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function user()
    {
        //return $this->belongsTo('App\Models\Tag');
        return $this->belongsTo('App\Models\User','user_id');
    }


    public function categories()
    {
        return $this->belongsToMany('App\Models\Category','product_categories');
    }

    public function related(){
        return $this->belongsToMany('App\Models\Category','product_categories');

    }
    

}
