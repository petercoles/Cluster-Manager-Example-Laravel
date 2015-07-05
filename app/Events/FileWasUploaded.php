<?php

namespace App\Events;

use App\Events\Event;

class FileWasUploaded extends Event
{
    public $file;

    /**
     * Create a new event instance.
     *
     * @param  String  $fileName
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }
}
