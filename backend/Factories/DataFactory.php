<?php

declare(strict_types=1);

namespace Internships\Factories;

use Internships\Exceptions\Validation\IsMissingValidationException;
use Internships\FileSystem\Path;
use Internships\Interfaces\BuildTool;
use Internships\Interfaces\SerializableInfo;
use Internships\Services\DataValidator;

abstract class DataFactory implements BuildTool, SerializableInfo
{
    protected DataValidator $dataValidator;

    protected array $fields;
    protected string $workingDirectory;

    protected string $sourcePath;
    protected string $sourceName;
    protected string $destinationPath;
    protected string $destinationName;

    public function __construct(DataValidator $dataValidator)
    {
        $this->dataValidator = $dataValidator;
        $this->setPaths();
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
        return $this->workingDirectory
            . Path::FOLDER_SEPARATOR
            . $this->sourcePath;
    }

    public function getSourceFileName(): string
    {
        return $this->sourceName;
    }

    public function getSourceFilePath(): string
    {
        return $this->getSourceRelativePath()
            . Path::FOLDER_SEPARATOR
            . $this->getSourceFileName();
    }

    public function getDestinationRelativePath(): string
    {
        return $this->workingDirectory
            . Path::FOLDER_SEPARATOR
            . $this->destinationPath;
    }

    public function getDestinationFileName(): string
    {
        return $this->destinationName;
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

    /**
     * @throws IsMissingValidationException
     */
    public function buildFromData(array $csvData): array
    {
        $this->onBuildStart();
        $dataObjects = [];
        $modelName = $this->getModelClassToBuild();
        foreach ($csvData as $rowNumber => $rowData) {
            if ($rowNumber > 0) {
                $entry = array_combine(array_keys($this->fields), array_values($rowData));
                $jsonId = $rowNumber - 1;
                $preparedEntry = $this->processEntry($jsonId, $this->validate($jsonId, $entry));
                $modelObject = new $modelName($jsonId, $preparedEntry);
                array_push($dataObjects, $modelObject);
            }
        }
        $this->onBuildEnd();
        return $dataObjects;
    }

    public function processEntry(int $entryId, array $entry): array
    {
        return $entry;
    }

    public function onBuildStart(): void
    {
    }

    public function onBuildEnd(): void
    {
    }
}
