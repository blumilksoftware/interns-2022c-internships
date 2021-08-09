<?php

declare(strict_types=1);

namespace Internships\Services;

use Internships\Exceptions\File\CsvInvalidCountFileException;
use Internships\Exceptions\File\NoFieldRowCsvException;
use Internships\Exceptions\Path\CouldNotReadPathException;
use Internships\Exceptions\Path\NotFoundPathException;
use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;

class CsvReader
{
    public const CSV_READ_LENGTH = 0;
    public const CSV_SEPARATOR = ",";

    public function __construct(
        protected DirectoryManager $directoryManager,
        protected FileManager $fileManager
    ) {
    }

    /**
     * @throws CsvInvalidCountFileException
     * @throws NotFoundPathException
     * @throws CouldNotReadPathException
     * @throws NoFieldRowCsvException
     */
    public function getCsvData(string $resourceRelativePath, string $fileName, array $fieldDefines, bool $fieldRowOnly = false): array
    {
        $fullPath = $this->directoryManager->getResourceFilePath($resourceRelativePath, $fileName);
        $csvRows = [];
        if (!file_exists($fullPath)) {
            throw new NotFoundPathException($fullPath);
        }
        $csvFile = fopen($fullPath, "rb");
        if (!$csvFile) {
            throw new CouldNotReadPathException($fullPath);
        }
        $currentRow = -1;
        try {
            while (($row = fgetcsv($csvFile, static::CSV_READ_LENGTH, static::CSV_SEPARATOR)) !== false) {
                $currentRow++;
                $rowFieldCount = count($row);
                $fieldCount = count($fieldDefines);
                if ($rowFieldCount !== $fieldCount) {
                    throw new CsvInvalidCountFileException($fullPath, $currentRow, $fieldCount, $rowFieldCount);
                }
                $row = array_combine(array_keys($fieldDefines), $row);
                array_push($csvRows, $row);
                if ($fieldRowOnly) {
                    break;
                }
            }
        } finally {
            fclose($csvFile);
        }
        if ($currentRow < 0) {
            throw new NoFieldRowCsvException($fullPath);
        }
        return $csvRows;
    }

    public function getFieldRow(string $resourceRelativePath, string $fileName, array $fieldDefines)
    {
        return $this->getCsvData($resourceRelativePath, $fileName, $fieldDefines, fieldRowOnly: true)[0];
    }

    public function saveData(string $resourceRelativePath, string $fileName, array $data): void
    {
        $fullPath = $this->directoryManager->getResourceFilePath($resourceRelativePath, $fileName);
        if (!file_exists($fullPath)) {
            $this->fileManager->createInResources($resourceRelativePath, $fileName, "");
        }

        $csvFile = fopen($fullPath, "w");
        try {
            foreach ($data as $row) {
                fputcsv($csvFile, $row);
            }
        } finally {
            fclose($csvFile);
        }
    }
}
