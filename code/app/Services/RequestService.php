<?php

namespace App\Services;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Http;
use Exception;

class RequestService
{
    /**
    * @var string
    **/
    private $urlEndpoint;

    public function __construct(string $urlEndpoint)
    {
        $this->urlEndpoint = $urlEndpoint;
    }

    public function __invoke(): void
    {
        $response = Http::post($this->urlEndpoint);

        if (!$response->successful()) {
            throw new Exception();
        }
    }
}
