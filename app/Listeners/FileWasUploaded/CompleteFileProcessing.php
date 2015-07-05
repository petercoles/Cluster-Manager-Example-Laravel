<?php

namespace App\Listeners\FileWasUploaded;

use Log;

class CompleteFileProcessing
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        // not sure yet exactly what this would do,
        // but it feels as though there's likely to be a tidying up step,
        // so this is a placeholder for it
        Log::info('complete file processing (not yet active)');
    }
}
