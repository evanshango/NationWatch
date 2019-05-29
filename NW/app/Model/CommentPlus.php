<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CommentPlus extends Model
{
    public function comment(){
        return $this->belongsTo(Comment::class);
    }
}
