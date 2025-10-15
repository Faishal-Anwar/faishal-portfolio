<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'category', 'client', 'link', 'image', 'image_public_id', 'overview', 'tech_stack', 'is_featured', 'approach', 'vision', 'design', 'conclusion', 'slug'
    ];

    /**
     * The stacks that belong to the project.
     */
    public function stacks()
    {
        return $this->belongsToMany(Stack::class, 'project_stack');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}