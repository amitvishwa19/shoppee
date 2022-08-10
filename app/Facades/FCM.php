<?php

namespace App\Facades;


use App\Services\FirebaseMessaging;
use Illuminate\Support\Facades\Facade;

class FCM extends Facade
{
    protected static function getFacadeAccessor(){
        return 'fcm';
    }
}
