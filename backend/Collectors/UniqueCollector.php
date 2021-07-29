<?php

declare(strict_types=1);

namespace Internships\Collectors;

use Internships\Models\CollectedContent;
use JsonSerializable;

abstract class UniqueCollector implements JsonSerializable
{
    /** @var CollectedContent[] */
    protected array $collectedContent;
    protected int $nextIdToAssign;

    public function __construct()
    {
        $this->clearData();
    }

    public function clearData(): void
    {
        $this->nextIdToAssign = 0;
        $this->collectedContent = [];
    }

    public function collectAndGetID(string $content, int $matchId): int
    {
        foreach ($this->collectedContent as $collected) {
            if ($collected->getCollectedName() === $content) {
                $collected->pushMatchId($matchId);
                return $collected->getID();
            }
        }
        $newId = $this->nextIdToAssign++;
        $collectedItem = new CollectedContent($newId, $content);
        $collectedItem->pushMatchId($matchId);
        array_push($this->collectedContent, $collectedItem);
        return $newId;
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
