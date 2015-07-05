<?php

namespace App\Services;

use Kuroi\Cluster\Servers\Server;
use Kuroi\Cluster\Servers\Adapters\DigitalOcean;

class Workers
{
    protected $server;

    public function __construct()
    {
        $this->server = new Server(
            new DigitalOcean(['token' => env('DIGITALOCEAN_PERSONAL_ACCESS_TOKEN')])
        );
    }

    /**
     * Count the number of workers. At the moment it's assumed that there's
     * one managers and everything else is a worker. Clearly not agood approach
     * @todo improve by checking server name
     *
     * @return integer
     */
    public function count()
    {
        return $this->server->read()->meta->total - 1;
    }

    public function add()
    {
        $this->server->create(
            [
                "name" => 'worker',
                "region" => "lon1",
                "size" => "1gb",
                "image" => $this->image(),
            ]
        );
    }

    public function deleteAll()
    {
        foreach ($this->server->read()->droplets as $droplet) {
            if ('worker' == $droplet->name) {
                $this->server->delete($droplet->id);
            }
        }
    }

    private function image()
    {
        foreach ($this->server->images(['private' => 'true'])->images as $image) {
            if ($image->name == 'worker') {
                return $image->id;
            }
        }
    }
}
