<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Services\AWS\AWSService;

class AwsServiceProvider extends ServiceProvider
{

    const VERSION = '3.6.0';
    protected $defer = true;


     /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }



    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('aws', function ($app) {
            $config = $app->make('config')->get('aws');

            return new Sdk($config);
        });

        $this->app->alias('aws', 'Aws\Sdk');
    }

    public function provides()
    {
        return ['aws', 'Aws\Sdk'];
    }


}
