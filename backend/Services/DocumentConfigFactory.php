<?php


namespace Internships\Services;


use Internships\Models\DocumentConfig;
use Internships\Models\ValidationOptions;

class DocumentConfigFactory extends DataFactory
{

    public function setPaths(): void
    {
        $this->workingDirectory = "";
        $this->sourcePath = "/documents/";
        $this->sourceName = "documents.csv";
        $this->destinationPath = "/documents/";
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