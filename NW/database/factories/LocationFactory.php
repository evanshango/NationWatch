<?php

/* @var $factory Factory */

use App\Model\Location;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'code' => $faker->numberBetween(100, 999),
        'name' => $faker->city,
        'longitude' => $faker->longitude($min = -180, $max = 180),
        'latitude' => $faker->latitude($min = -90, $max = 90)
    ];
});
