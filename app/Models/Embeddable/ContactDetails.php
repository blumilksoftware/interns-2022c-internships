<?php

declare(strict_types=1);

namespace Internships\Models\Embeddable;

use Spatie\LaravelData\Data;

class ContactDetails extends Data
{
    public function __construct(
        public readonly string $email,
        public readonly ?string $phone_number,
        public readonly ?string $website_url,
    ) {}
}
