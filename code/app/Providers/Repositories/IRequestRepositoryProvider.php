<?php

namespace App\Providers\Repositories;

use App\Contracts\Repositories\IRequestRepository;
use App\Repositories\RequestRepository;
use Illuminate\Support\ServiceProvider;

class IRequestRepositoryProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            IRequestRepository::class,
            RequestRepository::class
        );
    }
}
