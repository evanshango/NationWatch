<?php

/* @var $factory Factory */

use App\Model\Comment;
use App\Model\CommentPlus;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(CommentPlus::class, function (Faker $faker) {
    return [
        'comment_id' => function () {
            return Comment::all()->random();
        },
        'user_id' => function () {
            return \App\User::all()->random();
        }
    ];
});
