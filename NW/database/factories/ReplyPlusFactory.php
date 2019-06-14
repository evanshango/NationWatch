<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\ReplyPlus;
use Faker\Generator as Faker;

$factory->define(ReplyPlus::class, function (Faker $faker) {
    return [
        'reply_id' => function () {
            return \App\Model\Reply::all()->random();
        },
        'user_id' => function () {
            return \App\User::all()->random();
        }
    ];
});
