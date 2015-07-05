<?php

namespace App\Listeners\Teardown;

use App\Services\Workers;

class PowerDownServers
{
    protected $workers;

    public function __construct(Workers $workers)
    {
        $this->workers = $worker;
    }

    /**
     * Power down any worker servers
     *
     * @return void
     */
    public function handle()
    {
        $this->workers->deleteAll();
    }
}
