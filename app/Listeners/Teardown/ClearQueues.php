<?php

namespace App\Listeners\Teardown;

use Kuroi\Cluster\Queues\Queue;
use Kuroi\Cluster\Queues\Adapters\IronMQ;

class ClearQueues
{
    protected $queue;

    public function __construct()
    {
        $this->queue = new Queue(
            new IronMQ(['token' => env('IRON_TOKEN'), 'project' => env('IRON_PROJECT')])
        );
    }

    /**
     * Clear document queues waiting to be processed
     *
     * @return void
     */
    public function handle()
    {
        $this->queue->clear('generator');
    }
}
