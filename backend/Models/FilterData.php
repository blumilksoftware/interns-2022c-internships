<?php

declare(strict_types=1);

namespace Internships\Models;

use JsonSerializable;

class FilterData implements JsonSerializable
{
    protected int $specializationID;
    protected array $tags;

    public function __construct(int $specialization, array $tags)
    {
        $this->specializationID = $specialization;
        $this->tags = $tags;
    }

    public function getSpecializationID(): int
    {
        return $this->specializationID;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function jsonSerialize(): array
    {
        return [
            "specialization" => $this->specializationID,
            "tags" => $this->tags,
        ];
    }
}
