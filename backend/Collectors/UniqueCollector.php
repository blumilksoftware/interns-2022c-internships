<?php


namespace Internships\Collectors;


use Internships\Models\CollectedContent;
use JsonSerializable;

abstract class UniqueCollector implements JsonSerializable
{
    /* @var $collectedContent CollectedContent[] */
    protected array $collectedContent;
    protected int $nextIdToAssign;

    public function __construct()
    {
        $this->nextIdToAssign = 0;
        $this->collectedContent = [];
    }

    public function collectAndGetId(string $content): int
    {
        foreach ($this->collectedContent as $collected) {
            if ($collected->getCollectedName() == $content) {
                return $collected->getId();
            }
        }
        $newId = $this->nextIdToAssign++;
        array_push($this->collectedContent, new CollectedContent($newId, $content));
        return $newId;
    }
}