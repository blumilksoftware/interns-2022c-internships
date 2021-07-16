<?php

declare(strict_types=1);

namespace Internships\Services;

use Internships\Models\Faculty;
use Internships\Models\PathPair;
use Internships\Models\ValidationOptions;

class FacultyDataBuilder extends DataBuilder
{
    public function __construct(
        string $workingDirectory,
        PathPair $source,
        Pathpair $destination
    ) {
        parent::__construct($workingDirectory, $source, $destination);
    }

    public function defineDataFields(): void
    {
        $this->fields = [
            "name" => new ValidationOptions(required: true),
            "directory" => new ValidationOptions(required: true),
        ];
    }

    public function buildFromData(array $csvData): array
    {
        $faculties = [];
        foreach ($csvData as $rowNumber => $rowData) {
            if ($rowNumber > 0) {
                $entry = array_combine(array_keys($this->fields), array_values($rowData));
                $jsonID = $rowNumber - 1;
                array_push($faculties, new Faculty($jsonID, $this->validate($jsonID, $entry)));
            }
        }
        return $faculties;
    }
}
