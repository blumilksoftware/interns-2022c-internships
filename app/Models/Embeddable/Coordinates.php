<?php

declare(strict_types=1);

namespace Internships\Models\Embeddable;

use JessArcher\CastableDataTransferObject\CastableDataTransferObject;

class Coordinates extends CastableDataTransferObject
{
    public readonly float $latitude;
    public readonly float $longitude;
}
