<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Education> */
class EducationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'institution' => $this->faker->company(),
            'degree' => $this->faker->jobTitle(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
        ];
    }
}
