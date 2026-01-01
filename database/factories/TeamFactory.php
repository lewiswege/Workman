<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['MT', 'VH']),
            'identity' => strtoupper(fake()->bothify('???-####')),
            'leader' => fake()->name(),
        ];
    }
}
