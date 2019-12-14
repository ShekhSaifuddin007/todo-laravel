<?php

/** @var Factory $factory */

use App\Model;
use App\Todo;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Todo::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'completed' => false,
    ];
});
