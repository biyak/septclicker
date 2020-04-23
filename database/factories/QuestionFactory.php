<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Question::class, function (Faker $faker) {
    return [
        'quiz_id' => 0,
        'question_text' => $faker->text(),
        'question_ans' => 'a',
        'option_a' => $faker->text(),
        'option_b' => $faker->text(),
        'option_c' => $faker->text(),
        'option_d' => $faker->text(),
        'option_e' => $faker->optional()->text()
    ];
});
