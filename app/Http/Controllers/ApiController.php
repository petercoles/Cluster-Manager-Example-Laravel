<?php

namespace App\Http\Controllers;

use App\Repositories\Documents;
use App\Services\Workers;
use App\Services\GeneratorQueue;
use App\Events\Teardown;

class ApiController extends Controller
{
    protected $documents;

    protected $workers;

    protected $queue;

    public function __construct(Documents $documents, Workers $workers, GeneratorQueue $queue)
    {
        $this->documents = $documents;
        $this->workers = $workers;
        $this->queue = $queue;
    }

    public function clusterStats()
    {
        $workers = $this->workers->count();

        $jobs = $this->queue->count();

        return json_encode(['managers' => 1, 'workers' => $workers, 'jobs' => $jobs]);
    }

    public function documentList()
    {
        return $this->documents->latest();
    }

    public function teardown()
    {
        event(new Teardown);
    }
}
