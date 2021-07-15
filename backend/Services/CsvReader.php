<?php

declare(strict_types=1);

namespace Internships\Services;

use Exception;

class CsvReader
{
    public const CSV_READ_LENGTH = 0;
    public const CSV_SEPARATOR = ",";

    public function getCSVData(string $fullPath, array $fieldDefines): array
    {
        $csvRows = [];
        try {
            if (!file_exists($fullPath)) {
                throw new Exception("File " . $fullPath . " not found");
            }
            $csvFile = fopen($fullPath, "rb");
            if (!$csvFile) {
                throw new Exception("File " . $fullPath . " cannot be read");
            }
            while (($row = fgetcsv($csvFile, self::CSV_READ_LENGTH, self::CSV_SEPARATOR)) !== false) {
                if ($rowCount = count($row)
                    !== $fieldCount = count($fieldDefines)) {
                    throw new Exception(
                        "Unexpected field count at row " . count($csvRows) + 1
                        . "Expected " . $fieldCount . ", got " . $rowCount
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
