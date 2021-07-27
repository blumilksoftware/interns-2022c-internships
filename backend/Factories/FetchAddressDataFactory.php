<?php


namespace Internships\Factories;


use Internships\Models\FetchAddress;
use Internships\Models\ValidationOptions;

class FetchAddressDataFactory extends DataFactory
{
    public function defineDataFields()
    {
        $this->fields = [
            "name" => new ValidationOptions(required: true),
            "country" => new ValidationOptions(
                required: true,
                sanitizationFlags: SANITIZE_WHITESPACE_TRIM
                          | SANITIZE_CAPITALIZE_WORDS,
            ),
            "rawCoordinates" => new ValidationOptions(
                sanitizationFlags: SANITIZE_WHITESPACE_REMOVE,
            ),
            "street" => new ValidationOptions(required: true),
            "zip" => new ValidationOptions(required: true),
            "city" => new ValidationOptions(
                required: true,
                sanitizationFlags: SANITIZE_WHITESPACE_TRIM
                          | SANITIZE_CAPITALIZE_WORDS
            ),
            "specialization" => new ValidationOptions(),
            "tags" => new ValidationOptions(),
            "website" => new ValidationOptions(),
            "email" => new ValidationOptions(),
            "phoneNumber" => new ValidationOptions(),
            "isPaid" => new ValidationOptions(),
            "logoFile" => new ValidationOptions(),
            "socialsFacebook" => new ValidationOptions(),
            "socialsLinkedIn" => new ValidationOptions(),
        ];
    }

    public function getModelClassToBuild(): string
    {
        return FetchAddress::class;
    }

    public function setPaths(): void
    {
        $this->workingDirectory = "";
        $this->sourcePath = "";
        $this->sourceName = "companies.csv";
        $this->destinationPath = "";
        $this->destinationName = "companies.csv";
    }

    public function processEntry(array $entry): array
    {
        return $entry;
    }

    public function onBuildStart()
    {
    }

    public function onBuildEnd()
    {
    }
}