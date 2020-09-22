<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->sentence(),
        'slug' => Str::slug($title),
        'body' => $faker->text(),
        'featured_image' => $faker->imageUrl(),
        'featured_image_text' => $faker->sentence(),
        'published_at' => $faker->dateTime(),
    ];
});
