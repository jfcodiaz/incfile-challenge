<?php

namespace App\Providers;

use App\Contracts\Repositories\IRequestRepository;
use Illuminate\Support\ServiceProvider;
use App\Services\RequestService;
use Illuminate\Foundation\Application;

class RequestServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(RequestService::class, function (Application $app) {
            return new RequestService(
                $app['config']['app.endpoint'],
                $app->make(IRequestRepository::class)
            );
        });
    }

}
