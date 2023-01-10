<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            "first_name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "email" => fake()->safeEmail(),
            "email_verified_at" => now(),
            "password" => bcrypt("password"),
            "remember_token" => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                "email_verified_at" => null,
            ];
        });
    }
}
