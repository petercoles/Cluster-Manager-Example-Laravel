<?php

namespace App\Listeners\FileWasUploaded;

use Log;

class VerifyBatchFile
{
    /**
     * Handle the event.
     *
     * @param  FileWasUploaded  $event
     * @return void
     */
    public function handle($event)
    {
        // @todo short-term add some basic verification processing
        // @todo long-term integrate Dave's verify component
        // for now assume verification passed and move file to next stage

        // for the time being, just log that we've been here
        Log::info('verify file (partially active)');
    }
}
