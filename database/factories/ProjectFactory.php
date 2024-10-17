<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Project> */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->colorName(),
            'description' => $this->faker->sentence(),
            'project_url' => $this->faker->url(),
            'source_url' => 'https://github.com/PHLAK/death-star',
        ];
    }
}
