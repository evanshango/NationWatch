<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ReportComment extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comment(){
        return $this->belongsTo(Comment::class);
    }
}
