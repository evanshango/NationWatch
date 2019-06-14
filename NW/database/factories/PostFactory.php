<?php

/* @var $factory Factory */

use App\Model\Post;
use App\Model\Tag;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return User::all()->random();
        },
        'media_type' => $faker->numberBetween($min = 0, $max = 0),
//        'media' => $faker->imageUrl($width = 640, $height = 480),
        'media' => 'https://placeimg.com/640/480/any?' . rand(1, 100),
        'tag1_id' => function ()
    {
        return Tag::all()->random();
    },
        'tag2_id' => function ()
    {
        return Tag::all()->random();
    },
        'tag3_id' => function ()
    {
        return Tag::all()->random();
    },
        'text' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'is_positive' => $faker->numberBetween($min = 0, $max = 1)
    ];
});
