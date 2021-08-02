<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Experience> */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company' => $this->faker->company(),
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(3),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'location' => "{$this->faker->city()}, {$this->faker->state()}",
        ];
    }
}
