<?php

declare(strict_types=1);

namespace Internships\Services;

use Internships\Exceptions\File\CsvInvalidCountFileException;
use Internships\Exceptions\File\FileException;
use Internships\Exceptions\File\NoFieldRowCsvException;
use Internships\Exceptions\Path\CouldNotReadPathException;
use Internships\Exceptions\Path\NotFoundPathException;
use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;
use Internships\FileSystem\RelativePathIdentity;

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
    public function getCsvData(RelativePathIdentity $relativePathIdentity, array $fieldDefines, bool $fieldRowOnly = false): array
    {
        $fullPathIdentity = $this->directoryManager->getFullPathIdentity($relativePathIdentity, true);
        $fullPath = $fullPathIdentity->getFullDestinationFilePath();
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

    public function getFieldRow(RelativePathIdentity $relativePathIdentity, array $fieldDefines)
    {
        return $this->getCsvData($relativePathIdentity, $fieldDefines, fieldRowOnly: true)[0];
    }

    public function saveData(RelativePathIdentity $relativePathIdentity, array $data): void
    {
        $fullPathIdentity = $this->directoryManager->getFullPathIdentity($relativePathIdentity, true);
        $fullPath = $fullPathIdentity->getFullDestinationFilePath();
        if (!file_exists($fullPath)) {
            $this->fileManager->create($relativePathIdentity);
        }

        $csvFile = fopen($fullPath, "w");
        if (!$csvFile) {
            throw new FileException($fullPath);
        }

        try {
            foreach ($data as $row) {
                fputcsv($csvFile, $row);
            }
        } finally {
            fclose($csvFile);
        }
    }
}
