<?php

declare(strict_types=1);

namespace Internships\Models\Embeddable;

use JessArcher\CastableDataTransferObject\CastableDataTransferObject;

class ContactDetails extends CastableDataTransferObject
{
    public readonly string $email;
    public readonly ?string $phone_number;
    public readonly ?string $website_url;
}
