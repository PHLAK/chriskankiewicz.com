<?php

use Faker\Generator as Faker;

$factory->define(App\Education::class, function (Faker $faker) {
    return [
        'institution' => $faker->company(),
        'degree' => $faker->jobTitle(),
        'start_date' => $faker->date(),
        'end_date' => $faker->date(),
        'currently_enrolled' => false
    ];
});
