<?php

declare(strict_types=1);

namespace Internships\Models;

use JsonSerializable;

class Socials implements JsonSerializable
{
    public function __construct(
        protected string $facebook,
        protected string $linkedIn,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            "facebook" => $this->facebook,
            "linkedIn" => $this->linkedIn,
        ];
    }
}
