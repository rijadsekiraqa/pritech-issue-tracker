<?php

namespace App\Models;

use App\Models\Issue;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}
