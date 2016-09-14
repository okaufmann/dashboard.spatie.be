<?php

namespace App\Events\RlsNotifier;

use App\Events\DashboardEvent;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StatisticsFetched extends DashboardEvent
{
    /**
     * @var array
     */
    public $statistics;

    /**
     * Create a new event instance.
     *
     * @param array $statistics
     */
    public function __construct(array $statistics)
    {

        $this->statistics = $statistics;
    }
}
