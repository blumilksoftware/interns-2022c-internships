<?php

declare(strict_types=1);

namespace Internships\FileSystem;

class CsvReader
{
    public function __construct()
    {
    }

    public function getCSVData(string $fullPath): array
    {
        $csvRows = [];
        $csvFile = fopen($fullPath, "r");
        while (($row = fgetcsv($csvFile, 0, ",")) !== false) {
            array_push($csvRows, $row);
        }
        fclose($csvFile);
        return $csvRows;
    }
}
