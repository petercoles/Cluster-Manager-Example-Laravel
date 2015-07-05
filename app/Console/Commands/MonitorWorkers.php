<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Workers;
use App\Services\GeneratorQueue;

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

    protected $queue;

    protected $workers;

    /**
     * Create a new command instance.
     */
    public function __construct(Workers $workers, GeneratorQueue $queue)
    {
        parent::__construct();

        $this->queue = $queue;

        $this->workers = $workers;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $jobs = $this->queue->count();

        $workers = $this->workers->count();

        $this->adjustWorkers($workers, $jobs);
    }

    private function adjustWorkers($workers, $jobs)
    {
        if ($workers > 0 && $jobs == 0) {

            $this->workers->deleteAll();

        } elseif ($workers == 0 && $jobs > 0 ||
                  $workers == 1 && $jobs > 25 ||
                  $workers == 2 && $jobs > 200) {

            $this->workers->add();
        }
    }
}
