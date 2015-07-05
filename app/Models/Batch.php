<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = 'batches';
    protected $fillable = [
        'uploaded_file',
        'archived_file',
        'processing_complete',
    ];
}
