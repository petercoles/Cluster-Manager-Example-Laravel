<?php

namespace App\Listeners\FileWasUploaded;

use Log;
use App\Repositories\Batches;

class AcceptBatchFile
{
    protected $batches;

    public function __construct(Batches $batches)
    {
        $this->batches = $batches;
    }

    /**
     * Handle the event.
     *
     * @param  FileWasUploaded  $event
     * @return void
     */
    public function handle($event)
    {
        // record acceptance of the batch and add the batch ID to the event object
        $event->id = $this->batches->accept($event->file)->id;

        Log::info('receive file (not yet active)');
    }
}
