<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Batch;

class Batches
{
    protected $batch;

    public function __construct(Batch $batch)
    {
        $this->batch = $batch;
    }

    public function accept($file)
    {
        return $this->batch->create(['uploaded_file' => $file]);
    }

    public function archive($id, $file)
    {
        $batch = $this->batch->find($id);
        $batch->archived_file = $file;
        $batch->processing_complete = Carbon::now();
        $batch->save();
    }

    public function truncate()
    {
        $this->batch->truncate();
    }
}
