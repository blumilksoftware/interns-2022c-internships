<?php

declare(strict_types=1);

namespace Database\Factories\Embeddable;

use Internships\Models\Embeddable\Coordinates;

class AddressDefines
{
    public static function definition(): array
    {
        return [
            "country" => fake()->country(),
            "voivodeship" => ucfirst(fake()->word()),
            "city" => fake()->city(),
            "street" => fake()->streetName(),
            "postal_code" => fake()->postcode(),
            "coordinates" => Coordinates::from(CoordinatesDefines::definition()),
        ];
    }
}
