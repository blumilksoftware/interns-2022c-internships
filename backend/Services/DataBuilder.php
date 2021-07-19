<?php

declare(strict_types=1);

namespace Internships\Services;

use Internships\FileSystem\Path;
use Internships\Interfaces\BuildTool;
use Internships\Interfaces\SerializableInfo;
use Internships\Models\PathPair;

abstract class DataBuilder implements BuildTool, SerializableInfo
{
    protected DataValidator $dataValidator;
    protected array $fields;

    public function __construct(
        protected string $workingDirectory,
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
                fieldValidationOptions: $fieldOptions
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
            . Path::FOLDER_SEPARATOR
            . $this->workingDirectory;
    }

    public function getSourceFileName(): string
    {
        return $this->source->getFileName();
    }

    public function getSourceFilePath(): string
    {
        return $this->getSourceRelativePath()
            . Path::FOLDER_SEPARATOR
            . $this->getSourceFileName();
    }

    public function getDestinationRelativePath(): string
    {
        return $this->destination->getRelativePath()
            . Path::FOLDER_SEPARATOR
            . $this->workingDirectory;
    }

    public function getDestinationFileName(): string
    {
        return $this->destination->getFileName();
    }

    public function getDestinationFilePath(): string
    {
        return $this->getDestinationRelativePath()
            . Path::FOLDER_SEPARATOR
            . $this->getDestinationFileName();
    }

    public function setDirectory(string $directory): void
    {
        $this->workingDirectory = $directory;
    }

    public function buildFromData(array $csvData): array
    {
        $dataObjects = [];
        foreach ($csvData as $rowNumber => $rowData) {
            if ($rowNumber > 0) {
                $entry = array_combine(array_keys($this->fields), array_values($rowData));
                $jsonID = $rowNumber - 1;
                $modelName = $this->getModelClassToBuild();
                $modelObject = new $modelName($jsonID, $this->validate($jsonID, $entry));
                array_push($dataObjects, $modelObject);
            }
        }
        return $dataObjects;
    }
}
