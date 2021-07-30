<?php

declare(strict_types=1);

namespace Internships\Collectors;

use Internships\FileSystem\FileManager;
use Internships\FileSystem\Path;

abstract class MainCollector
{
    /** @var string[] */
    protected array $collectorClassNames;
    protected array $collectors;
    protected string $relativeSavingPath;
    protected string $filename;

    protected function __construct(
        protected FileManager $fileManager
    ) {
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

    public function saveToJson(string $workingDirectory): void
    {
        $jsonData = [];
        foreach ($this->collectors as $collector) {
            $jsonData = array_merge($jsonData, $collector->jsonSerialize());
        }

        $this->fileManager->createInApi(
            relativePath: $workingDirectory . Path::FOLDER_SEPARATOR . $this->relativeSavingPath,
            filename: $this->filename,
            content: json_encode($jsonData, $this->fileManager->getDefaultJsonFlags())
        );
    }
}
