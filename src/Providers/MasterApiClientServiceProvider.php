<?php

namespace BcAutomotive\MasterApiClient\Providers;

use Illuminate\Support\ServiceProvider;
use BcAutomotive\MasterApiClient\MasterApiClient;

class MasterApiClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->publishes([
            __DIR__.'/../../config/master-api-client.php' => config_path('master-api-client.php')
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->mergeConfigFrom(__DIR__.'/../../config/master-api-client.php', 'master-api-client');

        $this->app->singleton('master-api-client', function ($app) {
            return new MasterApiClient(
                $app['config']->get('master-api-client.api_key'),
                $app['config']->get('master-api-client.api_url'),
            );
        });


    }
}
