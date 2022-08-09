<?php

namespace App\Providers;

use App\Services\AppMailingService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class AppMailServiceProvider extends ServiceProvider// implements DeferrableProvider
{

    //protected $defer = true;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AppMailingService::class, function ($app) {
            return new AppMailingService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


    }
}


