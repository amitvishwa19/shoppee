<?php

namespace App\Facades;

use App\Services\Settings;
use Illuminate\Support\Facades\Facade;

class SettingFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return Settings::class;
    }
}
