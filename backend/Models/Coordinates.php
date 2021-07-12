<?php

declare(strict_types=1);

namespace Internships\Models;

use JsonSerializable;

class Coordinates implements JsonSerializable
{
    protected float $latitude;
    protected float $longitude;

    public function __construct(string $coordinates)
    {
        $arrCoordinates = explode(",", preg_replace("/\s+/", "", $coordinates));
        $this->latitude = floatval($arrCoordinates[0]);
        $this->longitude = floatval($arrCoordinates[1]);
        $this->normalize();
    }

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

    protected function normalize(): void
    {
        $this->latitude = floatval(number_format($this->latitude, 6));
        $this->longitude = floatval(number_format($this->longitude, 6));
    }
}
