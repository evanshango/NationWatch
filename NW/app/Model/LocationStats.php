<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LocationStats extends Model
{
    public function posts(){
        return $this->hasManyThrough(Post::class, Upvote::class);
    }
}
