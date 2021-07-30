<?php

declare(strict_types=1);

namespace Internships\Services;

use Internships\Exceptions\File\CsvInvalidCountFileException;
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

    public function getCSVData(string $resourceRelativePath, string $fileName, array $fieldDefines): array
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
        try {
            $currentRow = -1;
            while (($row = fgetcsv($csvFile, static::CSV_READ_LENGTH, static::CSV_SEPARATOR)) !== false) {
                $currentRow++;
                $rowFieldCount = count($row);
                $fieldCount = count($fieldDefines);
                if ($rowFieldCount !== $fieldCount) {
                    throw new CsvInvalidCountFileException($fullPath, $currentRow, $fieldCount, $rowFieldCount);
                }
                $row = array_combine(array_keys($fieldDefines), $row);
                array_push($csvRows, $row);
            }
        } finally {
            fclose($csvFile);
        }
        return $csvRows;
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
