<?php

namespace App\Services;

use Kuroi\Cluster\Queues\Queue;
use Kuroi\Cluster\Queues\Adapters\IronMQ;

class GeneratorQueue
{
    protected $queue;

    public function __construct()
    {
        $this->queue = new Queue(
            new IronMQ(['token' => env('IRON_TOKEN'), 'project' => env('IRON_PROJECT')])
        );
    }

    /**
     * Count the number of jobs in the generate queue.
     *
     * @return integer
     */
    public function count()
    {
        return $this->queue->count('generator')->size;
    }

    /**
     * Clear document generator queues waiting to be processed
     *
     * @return void
     */
    public function clear()
    {
        $this->queue->clear('generator');
    }
}
