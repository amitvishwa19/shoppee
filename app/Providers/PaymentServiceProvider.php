<?php

namespace App\Providers;


use App\Services\PaymentAPI;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class PaymentServiceProvider extends ServiceProvider //implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //dd('paymentserviceprovider loaded');


        $this->app->singleton(PaymentAPI::class, function ($app) {
            return new PaymentAPI("Wola new");
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
