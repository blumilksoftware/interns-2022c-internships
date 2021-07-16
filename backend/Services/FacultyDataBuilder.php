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
