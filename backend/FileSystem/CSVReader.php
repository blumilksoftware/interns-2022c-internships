<?php

declare(strict_types=1);

namespace Internships\FileSystem;

class CSVReader
{
    public function __construct()
    {
    }

    public function getCSVData(string $fullPath): array
    {
        $csvRows = array();
        $csvFile = fopen($fullPath, "r");
        while (($row = fgetcsv($csvFile, 0, ",")) !== false) {
            array_push($csvRows, $row);
        }
        fclose($csvFile);
        return $csvRows;
    }
}
