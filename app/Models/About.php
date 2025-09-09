<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'category',
        'title',
        'description',
        'start_date',
        'end_date',
        'is_showcased',
    ];
}
