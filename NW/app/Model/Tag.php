<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function tagStats(){
        return $this->belongsTo(TagStats::class);
    }
}
