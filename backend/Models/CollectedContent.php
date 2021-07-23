<?php


namespace Internships\Models;


use JsonSerializable;

class CollectedContent implements JsonSerializable
{
    protected int $id;
    protected string $collectedName;

    public function __construct(int $id, string $collectedName)
    {
        $this->id = $id;
        $this->collectedName = $collectedName;
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
        ];
    }
}