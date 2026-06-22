<?php

namespace App\Models;

use App\Models\Issue;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }


}
