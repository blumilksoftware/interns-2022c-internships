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

    public function clearData() : void
    {
        $this->nextIdToAssign = 0;
        $this->collectedContent = [];
    }

    public function collectAndGetID(string $content): int
    {
        foreach ($this->collectedContent as $collected) {
            if ($collected->getCollectedName() === $content) {
                return $collected->getID();
            }
        }
        $newId = $this->nextIdToAssign++;
        array_push($this->collectedContent, new CollectedContent($newId, $content));
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
