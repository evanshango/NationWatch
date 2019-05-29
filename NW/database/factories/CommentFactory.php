<?php

/* @var $factory Factory */

use App\Model\Comment;
use App\Model\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return User::all()->random();
        },
        'post_id' => function(){
            return Post::all()->random();
        },
        'description' => $faker->sentence,
        'image' => $faker->imageUrl($width = 640, $height = 480)
    ];
});
