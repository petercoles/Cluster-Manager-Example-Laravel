<?php

namespace App\Listeners\FileWasUploaded;

use Log;
use Storage;

class PrepareToProcessFile
{
    /**
     * Handle the event.
     *
     * @param  FileWasUploaded  $event
     * @return void
     */
    public function handle($event)
    {
        // prepend a timestamp for (close to) uniqueness
        $uniqueName = date('Y-m-d_H-i-s_').$event->file;

        // let's move the file to the processing area
        // in a larger system we might namespace this for different clients, but that might be overkill
        Storage::move("uploads/$event->file", "processing/$uniqueName");

        // and apply the new name so that subsequent steps know where to find it
        $event->file = $uniqueName;

        // nothing hapopening here yet, so we'll pass on through, noting that we've been here along the way
        Log::info('prepare to process data (not yet active)');
    }
}
