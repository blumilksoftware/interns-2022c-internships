<?php

declare(strict_types=1);

namespace Internships\Models;

use JsonSerializable;

class CollectedContent implements JsonSerializable
{
    /** @var int[] */
    protected array $matchIds;
    /** @var int[] */
    protected array $childIds;
    protected int $id;
    protected string $collectedName;

    public function __construct(int $id, string $collectedName)
    {
        $this->matchIds = [];
        $this->childIds = [];
        $this->id = $id;
        $this->collectedName = $collectedName;
    }

    public function pushMatchId(int $id): void
    {
        if (!in_array($id, $this->matchIds)) {
            array_push($this->matchIds, $id);
        }
    }

    public function pushRelatedChildId(int $id): void
    {
        if (!in_array($id, $this->childIds)) {
            array_push($this->childIds, $id);
        }
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
            "childrenIds" => $this->childIds,
        ];
    }
}
