<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName(),
        'description' => $faker->sentence(),
        'project_url' => $faker->url(),
        'source_url' => 'https://github.com/PHLAK/death-star'
    ];
});
