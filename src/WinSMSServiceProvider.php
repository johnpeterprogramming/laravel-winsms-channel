<?php

namespace Shipper\WinSMS;

use Illuminate\Support\ServiceProvider;

class WinSMSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish the configuration file
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/winsms.php' => config_path('winsms.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/winsms.php',
            'winsms'
        );

        // Register the service with parameters
        $this->app->singleton(WinSMSService::class, function ($app) {
            return new WinSMSService(config('winsms.api_key'));
        });

        // Optional: Bind a simpler key for facade access or other uses
        $this->app->bind('winsms', function ($app) {
            return $app->make(WinSMSService::class);
        });
    }
}
