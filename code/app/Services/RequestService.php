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
    private $urlEndpoint;

    private $requestRepository;

    private $sendRequestNotication;

    public function __construct(
        string $urlEndpoint,
        IRequestRepository $requestRepository,
        SendRequestNotifcationService $sendRequestNotication
    )
    {
        $this->urlEndpoint = $urlEndpoint;
        $this->requestRepository = $requestRepository;
        $this->sendRequestNotication = $sendRequestNotication;
    }

    public function __invoke(int $idRequest): void
    {
        $request = $this->requestRepository->getById($idRequest);

        $response = Http::post($this->urlEndpoint);

        $request->status = $response->status();
        $request->delivered_at = $response->successful() ? new DateTime() : null;
        $request->save();

        if ($response->successful()) {
            ($this->sendRequestNotication)();
            return;
        }

        throw new Exception();
    }
}
