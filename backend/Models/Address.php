<?php

declare(strict_types=1);

namespace Internships\Models;

use JsonSerializable;

class Address implements JsonSerializable
{
    protected int $countryID;
    protected Coordinates $coordinates;
    protected string $street;
    protected string $zip;
    protected int $cityID;

    public function __construct(int $country, array $coordinates, string $street, string $zip, int $city)
    {
        $this->countryID = $country;
        $this->coordinates = new Coordinates($coordinates[0], $coordinates[1]);
        $this->street = $street;
        $this->zip = $zip;
        $this->cityID = $city;
    }

    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    public function getCountryID(): int
    {
        return $this->countryID;
    }

    public function getCityID(): int
    {
        return $this->cityID;
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
            "countryID" => $this->countryID,
            "cityID" => $this->cityID,
            "street" => $this->street,
            "zip" => $this->zip,
        ];
    }
}
