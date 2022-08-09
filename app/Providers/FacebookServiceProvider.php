<?php

namespace App\Providers;

use Facebook\Facebook;
use Illuminate\Support\ServiceProvider;

class FacebookServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Facebook::class,function($app){
            return new Facebook([
                'app_id' => config('services.facebook.client_id'),
                'app.secret' => config('services.facebook.client_secret'),
                'default_graph_version' => 'v2.12'
            ]);
        });
    }
}
