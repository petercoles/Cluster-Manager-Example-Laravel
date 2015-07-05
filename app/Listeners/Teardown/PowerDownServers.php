<?php

namespace App\Listeners\Teardown;

use Kuroi\Cluster\Servers\Server;
use Kuroi\Cluster\Servers\Adapters\DigitalOcean;

class PowerDownServers
{
    protected $server;

    public function __construct()
    {
        $this->server = new Server(
            new DigitalOcean(['token' => env('DIGITALOCEAN_PERSONAL_ACCESS_TOKEN')])
        );
    }

    /**
     * Power down any worker servers
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->server->read()->droplets as $droplet) {
            if ('worker' == $droplet->name) {
                $this->server->delete($droplet->id);
            }
        }
    }
}
