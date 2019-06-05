<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    protected $withCount = [
        'reply_pluses',
        'reports'
    ];

    public function comment(){
        return $this->belongsTo(Reply::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reply_pluses(){
        return $this->hasMany(ReplyPlus::class);
    }

    public function reports(){
        return $this->hasMany(ReportReply::class);
    }
}
