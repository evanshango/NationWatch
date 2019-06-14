<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $relations = [
        'posts'
    ];

    protected $hidden = [
      'created_at', 'updated_at'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function posts(){
        return $this->hasManyThrough(Post::class, User::class);
    }
}
