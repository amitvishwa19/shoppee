<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function client()
    {
        //return $this->belongsTo('App\Models\Tag');
        return $this->belongsTo('App\Models\Client','client_id');
    }

   

    public function requirements()
    {
        return $this->belongsToMany('App\Models\Requirement','project_requirement');
    }

    public function payments()
    {
        return $this->belongsToMany('App\Models\Payment','project_payment');
    }
}
