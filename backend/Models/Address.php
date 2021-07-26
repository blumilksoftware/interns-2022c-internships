<?php

declare(strict_types=1);

namespace Internships\Models;

use JsonSerializable;

class Address implements JsonSerializable
{
    protected int $countryId;
    protected Coordinates $coordinates;
    protected string $street;
    protected string $zip;
    protected int $cityId;

    public function __construct(int $country, array $coordinates, string $street, string $zip, int $city)
    {
        $this->countryId = $country;
        $this->coordinates = new Coordinates($coordinates[0], $coordinates[1]);
        $this->street = $street;
        $this->zip = $zip;
        $this->cityId = $city;
    }

    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function getCityId(): int
    {
        return $this->cityId;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getZipCode(): string
    {
        return $this->zip;
    }

    public function jsonSerialize(): array
    {
        return [
            "coordinates" => $this->coordinates,
            "countryId" => $this->countryId,
            "cityId" => $this->cityId,
            "street" => $this->street,
            "zip" => $this->zip,
        ];
    }
}
