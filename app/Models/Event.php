<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'classification_id',
        'name',
        'venue',
        'description',
        'startDate',
        'endDate',
        'hosts',
        'sponsors',
        'capacity'
    ];
}
