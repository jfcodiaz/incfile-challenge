<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestDelivered implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pendings;
    public $delivereds;
    public $total;

    public function __construct(int $total, int $pendings, int $delivereds)
    {
        $this->total = $total;
        $this->delivereds = $delivereds;
        $this->pendings = $pendings;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('channel-notifications');
    }
}
