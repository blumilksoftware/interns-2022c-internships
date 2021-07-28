<?php

declare(strict_types=1);

namespace Internships\Models;

use JsonSerializable;

class CollectedContent implements JsonSerializable
{
    /** @var int[] */
    protected array $matchIds;
    protected int $id;
    protected string $collectedName;

    public function __construct(int $id, string $collectedName)
    {
        $this->matchIds = [];
        $this->id = $id;
        $this->collectedName = $collectedName;
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getCollectedName(): string
    {
        return $this->collectedName;
    }

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->collectedName,
            "matchIds" => $this->matchIds,
        ];
    }
}
