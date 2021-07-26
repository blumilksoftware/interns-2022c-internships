<?php

declare(strict_types=1);

namespace Internships\Models;

use JsonSerializable;

class FilterData implements JsonSerializable
{
    protected int $specializationId;
    protected array $tags;

    public function __construct(int $specialization, array $tags)
    {
        $this->specializationId = $specialization;
        $this->tags = $tags;
    }

    public function getSpecializationId(): int
    {
        return $this->specializationId;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function jsonSerialize(): array
    {
        return [
            "specialization" => $this->specializationId,
            "tags" => $this->tags,
        ];
    }
}
