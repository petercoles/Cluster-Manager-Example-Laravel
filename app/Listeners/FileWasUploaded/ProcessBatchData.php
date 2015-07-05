<?php

namespace App\Listeners\FileWasUploaded;

use Log;
use Storage;
use League\Csv\Reader;
use App\Jobs\Generator;
use App\Repositories\Documents;
use Illuminate\Foundation\Bus\DispatchesJobs;

class ProcessBatchData
{
    use DispatchesJobs;

    public function __construct(Documents $documents)
    {
        $this->documents = $documents;
    }

    /**
     * Handle the event.
     *
     * @param  FileWasUploaded  $event
     * @return void
     */
    public function handle($event)
    {
        $csv = Reader::createFromPath(storage_path('app/processing/'.$event->file));

        foreach ($csv->fetchAssoc() as $document) {
            if ($document['reference']) {

                $this->documents->create($document);
                
                $job = (new Generator($document))->onQueue('generator');
                $this->dispatch($job);
            }
        }

        Log::info('iterate over data, passing each document out to a queue');
    }
}
