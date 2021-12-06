<?php

namespace App\Console\Commands;

use App\Contracts\Repositories\IRequestRepository;
use App\Jobs\DoRequest;
use App\Services\SendRequestNotifcationService;
use Illuminate\Console\Command;

class SendRequests extends Command
{
    protected $signature = 'app:send-requests {nRequests}';

    protected $description = 'Send n request to the endpoint';

    public function handle(
        IRequestRepository $requestRepository,
        SendRequestNotifcationService $sendRequestNotication
    ): int
    {
        $nRequests = (int) $this->argument('nRequests');
        for ($i = 0; $i < $nRequests; $i++) {
            DoRequest::dispatch($requestRepository->create()->id)
                ->onQueue('requests');
            ;
        }
        $sendRequestNotication();
        return Command::SUCCESS;
    }
}
