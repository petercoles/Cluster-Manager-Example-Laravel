<?php

namespace App\Listeners\Teardown;

use Storage;

class DeleteFiles
{
    /**
     * Delete documents sitting in the filesystem
     *
     * @return void
     */
    public function handle()
    {
        Storage::delete('app/documents/*.pdf');
    }
}
