<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Impersonate;
    //use LogsActivity;

    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'firstName',
        'lastName',
        'username',
        'email',
        'mobile',
        'title',
        'contact',
        'password',
        'status',
        'avatar_url',
        'verification_code',
        'facebook_token',
        'facebook_app_id',
        'facebook_page_id',
        'display_name',
        'fcm_device_id',
        'latitude',
        'longitude',
        'verification_method',
        'verification_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }


    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }


    
    

    ////Grocery  Ecomm

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
    
    public function cart_items()
    {
        return $this->hasMany('App\Models\Cart');
    }

    public function viewedItems()
    {
        return $this->hasMany('App\Models\ViewedProduct');
    }

    public function wishlist()
    {
        return $this->hasMany('App\Models\Wishlist');
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order')->orderBy('created_at','desc');
    }

    ////Grocery  Ecomm

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'text']);
        // Chain fluent methods for configuration options
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

   
    public function getJWTCustomClaims()
    {
        return [];
    }

}
