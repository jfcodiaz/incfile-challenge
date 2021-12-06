<?php

namespace App\Jobs;

use App\Services\RequestService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DoRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    private $idRequest;

    public function __construct(int $idRequest)
    {
        $this->idRequest = $idRequest;
    }

    public function handle(RequestService $requestService) : void
    {
        $requestService($this->idRequest);
    }
}
