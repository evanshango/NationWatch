<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TagStats extends Model
{
    protected $fillable = [
        'points'
    ];

    public function posts(){
        return $this->hasMany(Post::class, 'tag_id');
    }

    public function tag(){
        return $this->belongsTo(Tag::class);
    }
}
