<?php

declare(strict_types=1);

namespace Internships\Models;

use JsonSerializable;

class Address implements JsonSerializable
{
    protected string $countryLocaleCode;
    protected Coordinates $coordinates;
    protected string $street;
    protected string $zip;
    protected string $cityLocaleCode;

    public function __construct(string $country, string $coordinates, string $street, string $zip, string $city)
    {
        $this->countryLocaleCode = $country;
        $this->coordinates = new Coordinates($coordinates);
        $this->street = $street;
        $this->zip = $zip;
        $this->cityLocaleCode = $city;
    }

    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }
    public function getCountryLocaleCode(): string
    {
        return $this->countryLocaleCode;
    }
    public function getCityLocaleCode(): string
    {
        return $this->cityLocaleCode;
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
            "countryLocaleCode" => $this->countryLocaleCode,
            "cityLocaleCode" => $this->cityLocaleCode,
            "street" => $this->street,
            "zip" => $this->zip,
        ];
    }
}
