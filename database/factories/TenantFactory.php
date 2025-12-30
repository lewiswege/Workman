<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => fake()->dateTime(),
            'password' => fake()->password(),
            'phone_number' => fake()->phoneNumber(),
            'alternative_number' => fake()->word(),
            'house_number' => fake()->word(),
            'moved_in_at' => fake()->date(),
            'rememberToken' => Str::random(10),
        ];
    }
}
