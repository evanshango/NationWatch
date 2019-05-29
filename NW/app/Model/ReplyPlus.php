<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReplyPlus extends Model
{
    public function reply(){
        return $this->belongsTo(Reply::class);
    }
}
