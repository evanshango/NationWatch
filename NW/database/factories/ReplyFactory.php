<?php

/* @var $factory Factory */

use App\Model\Comment;
use App\Model\Reply;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'comment_id' => function(){
            return Comment::all()->random();
        },
        'user_id' => function(){
            return User::all()->random();
        },
        'reply' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
    ];
});
