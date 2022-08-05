<?php

declare(strict_types=1);

namespace InternshipsStatic\Models;

use JsonSerializable;

class FilterData implements JsonSerializable
{
    public function __construct(
        protected int $specializationId,
        protected array $tags,
    ) {}

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
