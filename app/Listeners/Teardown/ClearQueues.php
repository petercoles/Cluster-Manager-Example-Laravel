<?php

namespace App\Listeners\Teardown;

use App\Services\GeneratorQueue;

class ClearQueues
{
    protected $queue;

    public function __construct(GeneratorQueue $queue)
    {
        $this->queue = $queue;
    }

    /**
     * Clear document queues waiting to be processed
     *
     * @return void
     */
    public function handle()
    {
        $this->queue->clear();
    }
}
