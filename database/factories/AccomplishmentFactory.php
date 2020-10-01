<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccomplishmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->sentence(),
        ];
    }
}
