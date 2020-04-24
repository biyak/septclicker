<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Elevations::class, function (Faker $faker) {
    return [
        'used' => False,
        'code' => $faker->text()
    ];
});
