<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ReportPost extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
