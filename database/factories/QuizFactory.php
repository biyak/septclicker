<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Quiz::class, function (Faker $faker) {
    return [
        'timelimit' => 0,
        'user_id' => 0,
        'quiz_name' => $faker->text(),
        'quiz_weight' => $faker->randomNumber(2)
    ];
});
