<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SendRequestNotifcationService;

class SendRequestNotifcationProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SendRequestNotifcationService::class);
    }
}
