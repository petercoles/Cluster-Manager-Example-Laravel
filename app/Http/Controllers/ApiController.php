<?php

namespace App\Http\Controllers;

use Request;
use App\Repositories\Documents;
use Kuroi\Cluster\Servers\Server;
use Kuroi\Cluster\Servers\Adapters\DigitalOcean;
use Kuroi\Cluster\Queues\Queue;
use Kuroi\Cluster\Queues\Adapters\IronMQ;
use App\Events\Teardown;

class ApiController extends Controller
{
    protected $server;

    protected $queue;

    protected $documents;

    public function __construct(Documents $documents)
    {
        $this->server = new Server(
            new DigitalOcean(['token' => env('DIGITALOCEAN_PERSONAL_ACCESS_TOKEN')])
        );

        $this->queue = new Queue(
            new IronMQ(['token' => env('IRON_TOKEN'), 'project' => env('IRON_PROJECT')])
        );

        $this->documents = $documents;
    }

    public function clusterStats()
    {
        $workers = $this->server->read()->meta->total - 1;

        $jobs = $this->queue->count('generator')->size;

        return json_encode(['managers' => 1, 'workers' => $workers, 'jobs' => $jobs]);
    }

    public function documentList()
    {
        return $this->documents->latest();
    }

    public function document($id)
    {
        return $this->documents->find($id);
    }

    public function createDocument()
    {
        $this->documents->create(Request::all());
    }

    public function teardown()
    {
        event(new Teardown);
    }
}
