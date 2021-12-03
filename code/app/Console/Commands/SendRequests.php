<?php

namespace App\Console\Commands;

use App\Jobs\DoRequest;
use App\Services\RequestService;
use Illuminate\Console\Command;

class SendRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-requests {nRequests}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send n request to the endpoint';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $nRequests = (int) $this->argument('nRequests');
        for ($i = 0; $i < $nRequests; $i++) {
            DoRequest::dispatch();
        }

        return Command::SUCCESS;
    }
}
