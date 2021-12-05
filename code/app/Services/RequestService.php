<?php

namespace App\Services;

use App\Contracts\Repositories\IRequestRepository;
use App\Events\RequestDelivered;
use DateTime;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Http;
use Exception;

class RequestService
{
    /**
    * Send a simple POST request to the urlEndpoint
    *
    * @var string
    **/
    private $urlEndpoint;

    private $requestRepository;

    public function __construct(string $urlEndpoint, IRequestRepository $requestRepository)
    {
        $this->urlEndpoint = $urlEndpoint;
        $this->requestRepository = $requestRepository;
    }

    public function __invoke(int $idRequest): void
    {
        $request = $this->requestRepository->getById($idRequest);
        $response = Http::post($this->urlEndpoint);

        $request->status = $response->status();
        $request->delivered_at = $response->successful() ? new DateTime() : null;
        $request->save();

        if ($response->successful()) {
            RequestDelivered::dispatch(
                $this->requestRepository->getCount(),
                $this->requestRepository->getCountPendings(),
                $this->requestRepository->getCountDelivereds()
            );
            return;
        }

        throw new Exception();
    }
}
