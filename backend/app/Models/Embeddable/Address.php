<?php

declare(strict_types=1);

namespace Internships\Models\Embeddable;

use JessArcher\CastableDataTransferObject\CastableDataTransferObject;

class Address extends CastableDataTransferObject
{
    public readonly string $country;
    public readonly string $voivodeship;
    public readonly string $city;
    public readonly string $street;
    public readonly string $postal_code;
    public readonly Coordinates $coordinates;
}
