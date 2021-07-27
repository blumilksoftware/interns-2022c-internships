<?php


namespace Internships\Models;


class FetchAddress
{
    protected int $id;
    protected string $rawCoordinates;
    protected string $street;
    protected string $city;
    protected string $country;
    protected string $zip;

    public function __construct(int $id, array $data)
    {
        $this->id = $id;
        $this->rawCoordinates = $data["rawCoordinates"];
        $this->street = $data["street"];
        $this->city = $data["city"];
        $this->country = $data["country"];
        $this->zip = $data["zip"];
    }
}