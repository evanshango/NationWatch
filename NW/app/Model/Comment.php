<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $relations = [
        'user',
    ];

    protected $withCount = [
        'replies',
        'comment_pluses'
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function comment_pluses(){
        return $this->hasMany(CommentPlus::class);
    }
}
