<?php

declare(strict_types=1);

namespace Internships\Models\Embeddable;

use Spatie\LaravelData\Data;

class Address extends Data
{
    public function __construct(
        public readonly string $country,
        public readonly string $voivodeship,
        public readonly string $city,
        public readonly string $street,
        public readonly string $postal_code,
        public readonly Coordinates $coordinates,
    ) {}
}
