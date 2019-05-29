<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Downvote extends Model
{
    protected $hidden = [
        'id','updated_at'
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
