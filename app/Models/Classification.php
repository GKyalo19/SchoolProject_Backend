<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classification extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'class',
        'level',
        'category',
        'subject',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
