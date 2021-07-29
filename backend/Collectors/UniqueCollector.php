<?php

declare(strict_types=1);

namespace Internships\Collectors;

use Internships\Models\CollectedContent;
use JsonSerializable;
use OutOfBoundsException;

abstract class UniqueCollector implements JsonSerializable
{
    /** @var CollectedContent[] */
    protected array $collectedContent;
    protected int $nextIdToAssign;
    protected int $lastReturnedId;

    public function __construct()
    {
        $this->clearData();
    }

    public function clearData(): void
    {
        $this->lastReturnedId = -1;
        $this->nextIdToAssign = 0;
        $this->collectedContent = [];
    }

    public function collectAndGetID(string $content, int $matchId): int
    {
        foreach ($this->collectedContent as $collected) {
            if ($collected->getCollectedName() === $content) {
                $collected->pushSearchMatchId($matchId);
                return $collected->getId();
            }
        }
        $newId = $this->lastReturnedId = $this->nextIdToAssign++;
        $collectedItem = new CollectedContent($newId, $content);
        $collectedItem->pushSearchMatchId($matchId);
        array_push($this->collectedContent, $collectedItem);
        return $newId;
    }

    public function getLastReturnedId(): int
    {
        if ($this->lastReturnedId < 0 && $this->lastReturnedId >= count($this->collectedContent)) {
            throw new OutOfBoundsException();
        }
        return $this->lastReturnedId;
    }

    public function getLastUsedElement(): CollectedContent
    {
        return $this->collectedContent[$this->getLastReturnedId()];
    }

    public function jsonSerialize()
    {
        return [
            $this->getJsonTag() => $this->collectedContent,
        ];
    }

    public function getJsonTag(): string
    {
        return "default";
    }
}
