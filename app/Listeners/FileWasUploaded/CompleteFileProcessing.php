<?php

namespace App\Listeners\FileWasUploaded;

use Log;

class CompleteFileProcessing
{
    /**
     * Handle the event.
     *
     * @param  FileWasUploaded  $event
     * @return void
     */
    public function handle($event)
    {
        // not sure yet exactly waht this would do,
        // but it feels as though there's likely to be a tidying up step,
        // so this is a placeholder for it
        Log::info('complete file processing (not yet active)');
    }
}
