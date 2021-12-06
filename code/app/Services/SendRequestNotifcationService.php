<?php

namespace App\Services;

use App\Contracts\Repositories\IRequestRepository;
use App\Events\RequestDelivered;
use DateTime;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Http;
use Exception;

class SendRequestNotifcationService
{
    private $requestRepository;

    public function __construct(IRequestRepository $requestRepository)
    {
        $this->requestRepository = $requestRepository;
    }

    public function __invoke(): void
    {
        RequestDelivered::dispatch(
            $this->requestRepository->getCount(),
            $this->requestRepository->getCountPendings(),
            $this->requestRepository->getCountDelivereds()
        );
    }
}
