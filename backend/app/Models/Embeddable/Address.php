<?php

declare(strict_types=1);

namespace Internships\Models\Embeddable;

use JessArcher\CastableDataTransferObject\CastableDataTransferObject;

class Address extends CastableDataTransferObject
{
    public string $country;
    public string $voivodeship;
    public string $city;
    public string $street;
    public string $postal_code;
    public Coordinates $coordinates;
}
