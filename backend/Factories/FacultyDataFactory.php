<?php

declare(strict_types=1);

namespace Internships\Factories;

use Internships\Models\Faculty;
use Internships\Models\ValidationOptions;

class FacultyDataFactory extends DataFactory
{
    public function setPaths(): void
    {
        $this->workingDirectory = "";
        $this->sourcePath = "/faculties/";
        $this->sourceName = "faculties.csv";
        $this->destinationPath = "/faculties/";
        $this->destinationName = "faculties.json";
    }

    public function getModelClassToBuild(): string
    {
        return Faculty::class;
    }

    public function defineDataFields(): void
    {
        $this->fields = [
            "name" => new ValidationOptions(required: true),
            "directory" => new ValidationOptions(required: true),
        ];
    }
}
