<?php

namespace App\Http\Controllers;

use Log;
use Request;
use App\Repositories\Documents;
use App\Events\FileWasUploaded;

class ProcessController extends Controller
{
    protected $documents;

    public function __construct(Documents $documents)
    {
        $this->documents = $documents;
    }

    public function fileUpload()
    {
        if (Request::file('file')->isValid()) {

            // get the file details
            $file = Request::file('file');

            // store them ready to start the procesing
            $file->move(storage_path('app/uploads'), $file->getClientOriginalName());

            // fire an event to trigger the processing steps
            event(new FileWasUploaded($file->getClientOriginalName()));

        } else {

            // @todo some error handling if the file isn't valid
            Log::info('file not valid');
        }
    }

    public function receivePdf()
    {
        foreach (Request::all() as $name => $file) {

            $file->move(storage_path('app/documents'), $file->getClientOriginalName());

            // @todo need to pass back the document id for updating, but this will do for demo
            $reference = str_replace('.pdf', '', $file->getClientOriginalName());
            $this->documents->update($reference);
        }
    }
}
