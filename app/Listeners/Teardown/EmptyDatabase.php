<?php

namespace App\Listeners\Teardown;

use App\Repositories\Batches;
use App\Repositories\Documents;

class EmptyDatabase
{
    protected $batches;
    protected $documents;

    public function __construct(Batches $batches, Documents $documents)
    {
        $this->batches = $batches;
        $this->documents = $documents;
    }

    /**
     * Empty the database of document and batch data
     *
     * @return void
     */
    public function handle()
    {
        $this->batches->truncate();
        $this->documents->truncate();
    }
}
