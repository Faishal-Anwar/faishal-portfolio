<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stack extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'is_showcased',
    ];

    /**
     * The projects that belong to the stack.
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_stack');
    }
}