<?php

declare(strict_types=1);

namespace InternshipsStatic\Collectors;

use InternshipsStatic\FileSystem\FileManager;
use InternshipsStatic\FileSystem\RelativePathIdentity;

abstract class MainCollector
{
    /** @var array<string> */
    protected array $collectorClassNames;

    protected array $collectors;
    protected RelativePathIdentity $pathIdentity;

    protected function __construct(
        protected FileManager $fileManager,
        RelativePathIdentity $parentIdentity,
    ) {
        $this->pathIdentity->setParentIdentity($parentIdentity);
        $this->collectors = [];
        foreach ($this->collectorClassNames as $className) {
            array_push($this->collectors, new $className());
        }

        $this->collectors = array_combine($this->collectorClassNames, $this->collectors);
    }

    public function rebuild(): void
    {
        foreach ($this->collectors as $collector) {
            $collector->clearData();
        }
    }

    public function saveToJson(): void
    {
        $jsonData = [];
        foreach ($this->collectors as $collector) {
            $jsonData = array_merge($jsonData, $collector->jsonSerialize());
        }

        $this->fileManager->create(
            relativePathIdentity: $this->pathIdentity,
            content: json_encode($jsonData, $this->fileManager->getDefaultJsonFlags()) . "\n",
        );
    }
}
