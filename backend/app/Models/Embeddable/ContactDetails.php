<?php

declare(strict_types=1);

namespace Internships\Models\Embeddable;

use JessArcher\CastableDataTransferObject\CastableDataTransferObject;

class ContactDetails extends CastableDataTransferObject
{
    public string $email;
    public string $phone_number;
    public string $website_url;
}
