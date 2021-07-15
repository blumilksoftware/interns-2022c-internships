<?php

declare(strict_types=1);

namespace Internships\Services;

use Internships\Models\Faculty;
use Internships\Models\PathPair;

class FacultyDataBuilder extends DataBuilder
{
    public function __construct(
        string $workingDirectory,
        PathPair $source,
        Pathpair $destination
    ) {
        parent::__construct($workingDirectory, $source, $destination);
    }

    public function defineDataFields()
    {
        $this->fields = [
            "name",
            "directory",
        ];
    }

    public function buildFromData(array $csvData): array
    {
        $faculties = [];
        foreach ($csvData as $rowNumber => $rowData) {
            if ($rowNumber > 0) {
                $entry = array_combine($this->fields, $rowData);
                $offsetRowNumber = $rowNumber - 1;
                array_push($faculties, new Faculty($offsetRowNumber, $this->validate($offsetRowNumber, $entry)));
            }
        }
        return $faculties;
    }

    public function validate(int $entryID, array $entry): array
    {
        $entry["name"] = $this->dataValidator->validateField(
            $entry["name"],
            $entryID,
            fieldName: "name",
        );
        $entry["directory"] = $this->dataValidator->validateField(
            $entry["directory"],
            $entryID,
            fieldName: "directory",
        );
        return $entry;
    }
}
