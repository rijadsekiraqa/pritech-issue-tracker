<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
}
