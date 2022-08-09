<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    //use LogsActivity;


    protected $guarded = ['id'];

    public function author()
    {
        //return $this->belongsTo('App\Models\Tag');
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function tags()
    {
        //return $this->belongsTo('App\Models\Tag');
        return $this->belongsToMany('App\Models\Tag','post_tag');
    }


    public function categories()
    {
        return $this->belongsToMany('App\Models\Category','post_category');
    }


    public function LogActivity()
    {
        return activity()
            ->performedOn('$article')
            ->causedBy('$user')
            ->withProperties(['laravel' => 'awesome'])
            ->log('The subject name is :subject.name, the causer name is :causer.name and Laravel is :properties.laravel');

    }

}
