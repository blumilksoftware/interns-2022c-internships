<?php

declare(strict_types=1);

namespace InternshipsStatic\Models;

use JsonSerializable;

class Coordinates implements JsonSerializable
{
    public function __construct(
        protected float $latitude,
        protected float $longitude,
    ) {}

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function jsonSerialize(): array
    {
        return [
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
        ];
    }
}
