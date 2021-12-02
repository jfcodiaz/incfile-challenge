<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RequestService;
use Illuminate\Foundation\Application;

class RequestServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(RequestService::class, function (Application $app) {
            return new RequestService($app['config']['app.endpoint']);
        });
    }

    public function boot(): void
    {
        //
    }
}
