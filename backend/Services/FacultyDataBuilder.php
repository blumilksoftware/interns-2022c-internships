<?php

declare(strict_types=1);

namespace Internships\Services;

use Internships\Interfaces\SerializableInfo;
use Internships\Models\Faculty;
use Internships\Models\PathPair;

class FacultyDataBuilder extends DataBuilder implements SerializableInfo
{
    public function __construct(
        protected string $workingDirectory
    ) {
        parent::__construct($this->getSource(), $this->getDestination());
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
                array_push($faculties, new Faculty($i, $entry));
            }
        }
        return $faculties;
    }

    public function getSource(): PathPair
    {
        return new PathPair($this->workingDirectory, "faculties.csv");
    }

    public function getDestination(): PathPair
    {
        return new PathPair($this->workingDirectory, "faculties.json");
    }
}
