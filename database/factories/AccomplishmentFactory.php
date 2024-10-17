<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Accomplishment> */
class AccomplishmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence(),
        ];
    }
}
