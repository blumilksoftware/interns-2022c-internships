<?php


namespace Internships\Collectors;


use Internships\Interfaces\SerializableInfo;
use Internships\Models\CollectedContent;
use JsonSerializable;

abstract class UniqueCollector implements JsonSerializable, SerializableInfo
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

    public function getSourceRelativePath(): string
    {
        // TODO: Implement getSourceRelativePath() method.
    }

    public function getSourceFileName(): string
    {
        // TODO: Implement getSourceFileName() method.
    }

    public function getSourceFilePath(): string
    {
        // TODO: Implement getSourceFilePath() method.
    }

    public function getDestinationFilePath(): string
    {
        return $this->getDestinationRelativePath() . $this->getDestinationFileName();
    }
}