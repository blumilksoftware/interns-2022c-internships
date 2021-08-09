<?php

declare(strict_types=1);

namespace Internships\Factories;

use Internships\FileSystem\FileManager;
use Internships\FileSystem\RelativePathIdentity;
use Internships\Models\DocumentConfig;
use Internships\Models\ValidationOptions;
use Internships\Services\DataValidator;

class DocumentConfigFactory extends DataFactory
{
    protected array $documentsToCopyPaths = [];

    public function __construct(
        protected FileManager $fileManager,
        DataValidator $dataValidator
    ) {
        parent::__construct($dataValidator);
    }

    public function setPaths(): void
    {
        $this->workingDirectory = "";
        $this->pathIdentity = new RelativePathIdentity(
            rightBasePath: "/documents/",
            sourceName: "documents.csv",
            destinationName: "documents.json"
        );
    }

    public function getModelClassToBuild(): string
    {
        return DocumentConfig::class;
    }

    public function defineDataFields(): void
    {
        $this->fields = [
            "displayedName" => new ValidationOptions(required: true),
            "filePath" => new ValidationOptions(required: true),
        ];
    }

    public function processEntry(int $entryId, array $entry): array
    {
        $path = $this->getRelativePathIdentity()->getRelativePath() . $entry["filePath"];
        array_push($this->documentsToCopyPaths, $path);
        return $entry;
    }

    public function onBuildEnd(): void
    {
       // foreach ($this->documentsToCopyPaths as $documentPath) {
            //$this->fileManager->getResourceFilePathsFrom($documentPath);
        //}
      //  $this->documentsToCopyPaths = [];
    }
}
