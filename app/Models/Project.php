<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'year', 'description', 'image', 'gallery', 'icon', 'tags', 'slug', 'case_study', 'github_url', 'is_featured'];
    protected $casts = [
        'tags' => 'array',
        'gallery' => 'array'
    ];
}
