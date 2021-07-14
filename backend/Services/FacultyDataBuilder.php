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

    public function buildFromData(array $csvData): array
    {
        $faculties = [];
        foreach ($csvData as $i => $rowData) {
            if ($i > 0) {
                $entry = [
                    "name" => $rowData[0],
                    "directory" => $rowData[1],
                ];
                array_push($faculties, new Faculty($i - 1, $entry));
            }
        }
        return $faculties;
    }
}
