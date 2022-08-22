<?php

declare(strict_types=1);

namespace Database\Factories\Embeddable;

class CoordinatesDefines
{
    public static function definition(): array
    {
        return [
            "latitude" => fake()->latitude(),
            "longitude" => fake()->longitude(),
        ];
    }
}
