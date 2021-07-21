<?php

declare(strict_types=1);

namespace Internships\Services;

use Exception;
use Internships\FileSystem\DirectoryManager;

class CsvReader
{
    public const CSV_READ_LENGTH = 0;
    public const CSV_SEPARATOR = ",";

    public function __construct(
        protected DirectoryManager $directoryManager
    ) {
    }

    public function getCSVData(string $resourceRelativePath, string $fileName, array $fieldDefines): array
    {
        $fullPath = $this->directoryManager->getResourceFilePath($resourceRelativePath, $fileName);
        $csvRows = [];
        try {
            if (!file_exists($fullPath)) {
                throw new Exception("File {$fullPath} not found");
            }
            $csvFile = fopen($fullPath, "rb");
            if (!$csvFile) {
                throw new Exception("File {$fullPath} cannot be read");
            }
            $currentRow = -1;
            while (($row = fgetcsv($csvFile, static::CSV_READ_LENGTH, static::CSV_SEPARATOR)) !== false) {
                $currentRow++;
                $rowCount = count($row);
                $fieldCount = count($fieldDefines);
                if ($rowCount !== $fieldCount) {
                    throw new Exception(
                        "Unexpected field count at row {$currentRow}. Expected {$fieldCount}, got {$rowCount}"
                    );
                }
                array_push($csvRows, $row);
            }
            fclose($csvFile);
        } catch (Exception $e) {
            throw $e;
        }
        return $csvRows;
    }
}
