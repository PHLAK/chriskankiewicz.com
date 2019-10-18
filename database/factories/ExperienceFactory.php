<?php

use Faker\Generator as Faker;

$factory->define(App\Experience::class, function (Faker $faker) {
    return [
        'company' => $faker->company(),
        'title' => $faker->jobTitle(),
        'description' => $faker->paragraph(3),
        'start_date' => $faker->date(),
        'end_date' => $faker->date(),
        'location' => "{$faker->city()}, {$faker->state()}"
    ];
});
