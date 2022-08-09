<?php

namespace App\Facades;

use App\Services\Settings;
use App\Services\AppMailingService;
use Illuminate\Support\Facades\Facade;

class AppMailFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return AppMailingService::class;
    }
}
