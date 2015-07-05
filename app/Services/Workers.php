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
     * Count the number of currently-active workers.
     *
     * @return integer
     */
    public function count()
    {
        $count = 0;
        foreach ($this->server->read()->droplets as $server) {
            if ('worker' == $server->name) {
                $count++;
            }
        }
        return $count;
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
        foreach ($this->server->read()->droplets as $server) {
            if ('worker' == $server->name) {
                $this->server->delete($server->id);
            }
        }
    }

    private function image()
    {
        foreach ($this->server->images(['private' => 'true'])->images as $image) {
            if ('worker' == $image->name) {
                return $image->id;
            }
        }
    }
}
