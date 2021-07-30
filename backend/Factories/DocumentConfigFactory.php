<?php

declare(strict_types=1);

namespace Internships\Factories;

use Internships\Models\DocumentConfig;
use Internships\Models\ValidationOptions;

class DocumentConfigFactory extends DataFactory
{
    public function setPaths(): void
    {
        $this->workingDirectory = "";
        $this->baseSourcePath = "/documents/";
        $this->sourceName = "documents.csv";
        $this->baseDestinationPath = "/documents/";
        $this->destinationName = "documents.json";
    }

    public function getModelClassToBuild(): string
    {
        return DocumentConfig::class;
    }

    public function defineDataFields(): void
    {
        $this->fields = [
            "displayedName" => new ValidationOptions(required: true),
            "filePath" => new ValidationOptions(required: true),
        ];
    }
}
