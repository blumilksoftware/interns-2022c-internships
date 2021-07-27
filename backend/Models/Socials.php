<?php

declare(strict_types=1);

namespace Internships\Models;

use JsonSerializable;

class Socials implements JsonSerializable
{
    protected string $facebook;
    protected string $linkedIn;

    public function __construct(string $facebook, string $linkedIn)
    {
        $this->facebook = $facebook;
        $this->linkedIn = $linkedIn;
    }

    public function jsonSerialize(): array
    {
        return [
            "facebook" => $this->facebook,
            "linkedIn" => $this->linkedIn,
        ];
    }
}
