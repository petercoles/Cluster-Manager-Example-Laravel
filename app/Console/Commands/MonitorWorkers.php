<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kuroi\Cluster\Servers\Server;
use Kuroi\Cluster\Servers\Adapters\DigitalOcean;
use Kuroi\Cluster\Queues\Queue;
use Kuroi\Cluster\Queues\Adapters\IronMQ;

class MonitorWorkers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitor:workers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitor workers and jobs and align numbers when needed.';

    protected $server;

    protected $queue;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->server = new Server(
            new DigitalOcean(['token' => env('DIGITALOCEAN_PERSONAL_ACCESS_TOKEN')])
        );

        $this->queue = new Queue(
            new IronMQ(['token' => env('IRON_TOKEN'), 'project' => env('IRON_PROJECT')])
        );
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $jobs = $this->queue->count('generator')->size;

        $workers = $total = $this->server->read()->meta->total - 1;

        $this->adjustWorkers($workers, $jobs);
    }

    private function adjustWorkers($workers, $jobs)
    {
        if ($workers > 0 and $jobs == 0) {

            $this->deleteWorkers();

        } elseif ($workers == 0 and $jobs > 0 or
                  $workers == 1 and $jobs > 25 or
                  $workers == 2 and $jobs > 200) {

            $this->addWorker();
        }
    }

    private function workerImage()
    {
        foreach ($this->server->images(['private' => 'true'])->images as $image) {
            if ($image->name == 'worker') {
                return $image->id;
            }
        }
    }

    private function deleteWorkers()
    {
        foreach ($this->server->read()->droplets as $droplet) {
            if ('worker' == $droplet->name) {
                $this->server->delete($droplet->id);
            }
        }
    }

    private function addWorker()
    {
        $this->server->create(
            [
                "name" => 'worker',
                "region" => "lon1",
                "size" => "1gb",
                "image" => $this->workerImage(),
            ]
        );
    }
}
