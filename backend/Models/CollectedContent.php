<?php

declare(strict_types=1);

namespace Internships\Models;

use JsonSerializable;

class CollectedContent implements JsonSerializable
{
    /** @var array<int> */
    protected array $searchMatchIds;

    /** @var array<int> */
    protected array $childIds;

    public function __construct(
        protected int $id,
        protected string $collectedName,
    ) {
        $this->searchMatchIds = [];
        $this->childIds = [];
    }

    public function pushSearchMatchId(int $id): void
    {
        if (!in_array($id, $this->searchMatchIds, true)) {
            array_push($this->searchMatchIds, $id);
        }
    }

    public function pushRelatedChildId(int $id): void
    {
        if (!in_array($id, $this->childIds, true)) {
            array_push($this->childIds, $id);
        }
    }

    public function getId(): int
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
            "searchMatchIds" => $this->searchMatchIds,
            "childrenIds" => $this->childIds,
        ];
    }
}
