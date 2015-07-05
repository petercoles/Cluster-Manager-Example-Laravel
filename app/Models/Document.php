<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'customer',
        'reference',
        'street_address',
        'street_name',
        'city',
        'state',
        'postcode',
        'currency',
        'value',
        'path',
    ];
}
