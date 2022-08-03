<?php

declare(strict_types=1);

namespace InternshipsStatic\Factories;

use InternshipsStatic\FileSystem\RelativePathIdentity;
use InternshipsStatic\Models\Faculty;
use InternshipsStatic\Models\ValidationOptions;

class FacultyDataFactory extends DataFactory
{
    public function setPaths(): void
    {
        $this->relativePathIdentity = new RelativePathIdentity(
            leftBasePath: "/faculties/",
            sourceName: "faculties.csv",
            destinationName: "faculties.json",
        );
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
