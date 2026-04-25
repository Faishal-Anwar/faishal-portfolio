<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'image',
        'cv_path',
        'name',
        'title',
        'email',
        'github_url',
        'linkedin_url',
        'instagram_url',
    ];
}
