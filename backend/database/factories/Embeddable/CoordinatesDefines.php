<?php

declare(strict_types=1);

namespace Database\Factories\Embeddable;

class CoordinatesDefines
{
    public static function definition(): array
    {
        return [
            "latitude" => fake()->latitude(min: 49, max: 54),
            "longitude" => fake()->longitude(min: 14, max: 23),
        ];
    }
}
