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
    /** @var RelativePathIdentity[] */
    protected array $documentPathIdentities = [];

    public function __construct(
        protected FileManager $fileManager,
        DataValidator $dataValidator
    ) {
        parent::__construct($dataValidator);
    }

    public function setPaths(): void
    {
        $this->workingDirectory = "";
        $this->relativePathIdentity = new RelativePathIdentity(
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
        $filePath = $entry["filePath"];
        $fileName = basename($filePath);
        $relativeDocumentIdentity = new RelativePathIdentity(
            relativeChangingPath: substr($filePath, strlen($fileName)),
            sourceName: $fileName,
            destinationName: $fileName
        );
        $relativeDocumentIdentity->setParentIdentity($this->getRelativePathIdentity());
        array_push($this->documentPathIdentities, $relativeDocumentIdentity);
        return $entry;
    }

    public function onBuildEnd(): void
    {
        foreach ($this->documentPathIdentities as $documentIdentity) {
            $this->fileManager->copyResource($documentIdentity);
        }
        $this->documentPathIdentities = [];
    }
}
