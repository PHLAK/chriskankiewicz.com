<?php

use App\Accomplishment;
use Faker\Generator as Faker;

$factory->define(Accomplishment::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence()
    ];
});
