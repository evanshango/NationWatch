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
        'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'image' => 'https://placeimg.com/640/480/any?' . rand(1, 100)
    ];
});
