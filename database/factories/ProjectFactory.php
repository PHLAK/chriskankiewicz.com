<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Project> */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->colorName(),
            'description' => $this->faker->sentence(),
            'project_url' => $this->faker->url(),
            'source_url' => 'https://github.com/PHLAK/death-star',
        ];
    }
}
