<?php

declare(strict_types=1);

namespace Internships\Models;

class FetchAddress
{
    protected string $rawCoordinates;
    protected string $street;
    protected string $city;
    protected string $country;
    protected string $zip;

    public function __construct(
        protected int $id,
        array $data,
    ) {
        $this->rawCoordinates = $data["rawCoordinates"];
        $this->street = $data["street"];
        $this->city = $data["city"];
        $this->country = $data["country"];
        $this->zip = $data["zip"];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRawCoordinates(): string
    {
        return $this->rawCoordinates;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getZip(): string
    {
        return $this->zip;
    }
}
