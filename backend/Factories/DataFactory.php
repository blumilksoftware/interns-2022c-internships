<?php

declare(strict_types=1);

namespace Internships\Factories;

use Internships\Exceptions\Validation\IsMissingValidationException;
use Internships\FileSystem\RelativePathIdentity;
use Internships\Interfaces\BuildTool;
use Internships\Services\DataValidator;

abstract class DataFactory implements BuildTool
{
    protected DataValidator $dataValidator;

    protected array $fields;
    protected RelativePathIdentity $pathIdentity;

    public function __construct(DataValidator $dataValidator)
    {
        $this->dataValidator = $dataValidator;
        $this->setPaths();
        $this->defineDataFields();
    }

    public function validate(int $entryId, array $entry): array
    {
        foreach (array_keys($this->fields) as $fieldName) {
            $fieldOptions = $this->fields[$fieldName];
            $entry[$fieldName] = $this->dataValidator->validateField(
                fieldValue: $entry[$fieldName],
                entryId: $entryId,
                fieldName: $fieldName,
                fieldValidationOptions: $fieldOptions
            );
        }
        return $entry;
    }

    public function getRelativePathIdentity(): RelativePathIdentity
    {
        return $this->pathIdentity;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function changeDirectory(string $directory): void
    {
        $this->getRelativePathIdentity()->setChangingPathPart($directory);
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
