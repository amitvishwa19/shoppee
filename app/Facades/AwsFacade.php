<?php

namespace App\Facades;

use Aws\AwsClientInterface;
use Illuminate\Support\Facades\Facade;


class SettingFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'aws';
    }

}
