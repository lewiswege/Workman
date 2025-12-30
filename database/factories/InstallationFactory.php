<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InstallationFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'task_status' => fake()->word(),
            'name' => fake()->name(),
            'area' => fake()->word(),
            'package' => fake()->word(),
            'team_id' => fake()->word(),
            'status' => fake()->word(),
            'scheduled_on' => fake()->date(),
        ];
    }
}
