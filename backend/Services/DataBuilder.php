<?php

declare(strict_types=1);

namespace Internships\Services;

use Internships\Interfaces\BuildTool;
use Internships\Interfaces\SerializableInfo;
use Internships\Models\PathPair;

abstract class DataBuilder extends DataSanitizer implements BuildTool, SerializableInfo
{
    protected DataValidator $dataValidator;
    protected array $fields;

    public function __construct(
        protected string $temporaryDirectory,
        protected PathPair $source,
        protected PathPair $destination
    ) {
        $this->dataValidator = new DataValidator();
        $this->defineDataFields();
    }

    public function validate(int $entryID, array $entry): array
    {
        foreach (array_keys($this->fields) as $fieldName) {
            $fieldOptions = $this->fields[$fieldName];
            $entry[$fieldName] = $this->dataValidator->validateField(
                fieldValue: $entry[$fieldName],
                entryID: $entryID,
                fieldName: $fieldName,
                fieldSanitizationOptions: $fieldOptions
            );
        }
        return $entry;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function getSourceRelativePath(): string
    {
        return $this->source->getRelativePath()
            . PATHS_FOLDER_SEPARATOR
            . $this->temporaryDirectory;
    }

    public function getSourceFileName(): string
    {
        return $this->source->getFileName();
    }

    public function getSourceFilePath(): string
    {
        return $this->getSourceRelativePath()
            . PATHS_FOLDER_SEPARATOR
            . $this->getSourceFileName();
    }

    public function getDestinationRelativePath(): string
    {
        return $this->destination->getRelativePath()
            . PATHS_FOLDER_SEPARATOR
            . $this->temporaryDirectory;
    }

    public function getDestinationFileName(): string
    {
        return $this->destination->getFileName();
    }

    public function getDestinationFilePath(): string
    {
        return $this->getDestinationRelativePath()
            . PATHS_FOLDER_SEPARATOR
            . $this->getDestinationFileName();
    }

    public function setDirectory(string $directory): void
    {
        $this->temporaryDirectory = $directory;
    }
}
