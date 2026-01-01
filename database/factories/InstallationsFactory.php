<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstallationsFactory extends Factory
{

    public function definition(): array
    {
        return [
            'task_status' => fake()->word(),
            'name' => fake()->name(),
            'area' => fake()->city(),
            'package' => fake()->word(),
            'team_id' => Team::factory(),
            'status' => fake()->word(),
            'scheduled_on' => fake()->date(),
        ];
    }
}
