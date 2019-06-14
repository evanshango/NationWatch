<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\Post;
use App\Model\Upvote;
use App\User;
use Faker\Generator as Faker;

$factory->define(Upvote::class, function (Faker $faker) {
    return [
        'post_id' => function (){
        return Post::all()->random();
        },
        'user_id' => function (){
        return User::all()->random();
        }
    ];
});
