<?php

declare(strict_types=1);

namespace Internships\Models\Embeddable;

use Spatie\LaravelData\Data;

class Coordinates extends Data
{
    public function __construct(
        public readonly float $latitude,
        public readonly float $longitude,
    ) {}
}
