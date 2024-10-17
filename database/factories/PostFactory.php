<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<\App\Post> */
class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $title = $this->faker->sentence(),
            'slug' => Str::slug($title),
            'body' => $this->faker->text(),
            'featured_image_url' => $this->faker->imageUrl(),
            'featured_image_text' => $this->faker->sentence(),
            'published_at' => $this->faker->dateTime(),
        ];
    }
}
