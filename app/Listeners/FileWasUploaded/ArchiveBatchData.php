<?php

namespace App\Listeners\FileWasUploaded;

use Log;
use Storage;
use App\Repositories\Batches;

class ArchiveBatchData
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
     */
    public function handle($event)
    {
        // uploaded batch data has been processed, so we move it to some archive area
        // in a fully-implemented system, this would be way more sophisticated
        Storage::move("processing/$event->file", "processed/$event->file");

        // record the details of the archiving
        $this->batches->archive($event->id, $event->file);

        Log::info('recorded details of batch file archiving');
    }
}
