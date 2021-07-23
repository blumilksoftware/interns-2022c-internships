<?php

declare(strict_types=1);

namespace Internships\Collectors;

use Internships\FileSystem\FileManager;
use Internships\FileSystem\Path;

abstract class MainCollector
{
    protected array $collectorClassNames;
    protected array $collectors;
    protected string $relativeSavingPath;
    protected string $filename;

    protected function __construct(
        protected FileManager $fileManager
    ) {
        $this->rebuild();
    }

    public function rebuild(): void
    {
        $this->collectors = [];
        $collectorObjects = [];
        foreach ($this->collectorClassNames as $className) {
            array_push($collectorObjects, new $className());
        }
        $this->collectors = array_combine($this->collectorClassNames, $collectorObjects);
    }

    public function saveToJson(string $workingDirectory): void
    {
        $jsonKeys = [];
        foreach ($this->collectors as $collector) {
            array_push($jsonKeys, $collector->getJsonTag());
        }
        $jsonData = array_combine($jsonKeys, $this->collectors);

        $this->fileManager->create(
            relativePath: $workingDirectory . Path::FOLDER_SEPARATOR . $this->relativeSavingPath,
            filename: $this->filename,
            content: json_encode($jsonData, $this->fileManager->getDefaultJsonFlags())
        );
    }
}
