<?php

declare(strict_types=1);

namespace Internships\Services;

use Internships\Interfaces\SerializableInfo;
use Internships\Models\Company;
use Internships\Models\ValidationOptions;

class CompanyDataFactory extends DataFactory implements SerializableInfo
{
    public function setPaths(): void
    {
        $this->workingDirectory = "";
        $this->sourcePath = "";
        $this->sourceName = "companies.csv";
        $this->destinationPath = "";
        $this->destinationName = "companies.json";
    }

    public function getModelClassToBuild(): string
    {
        return Company::class;
    }

    public function defineDataFields(): void
    {
        $this->fields = [
            "name" => new ValidationOptions(required: true),
            "country" => new ValidationOptions(
                required: true,
                sanitizationFlags: SANITIZE_WHITESPACE_TRIM
                          | SANITIZE_CAPITALIZE_WORDS,
            ),
            "coordinates" => new ValidationOptions(
                required: true,
                sanitizationFlags: SANITIZE_WHITESPACE_REMOVE,
                arraySeparator: ",",
                maxDecimals: 6,
                expectedCount: 2
            ),
            "street" => new ValidationOptions(required: true),
            "city" => new ValidationOptions(
                required: true,
                sanitizationFlags: SANITIZE_WHITESPACE_TRIM
                          | SANITIZE_CAPITALIZE_WORDS
            ),
            "zip" => new ValidationOptions(required: true),
            "specialization" => new ValidationOptions(
                required: true,
                sanitizationFlags: SANITIZE_WHITESPACE_TRIM
                          | SANITIZE_CAPITALIZE_WORDS
            ),
            "tags" => new ValidationOptions(
                sanitizationFlags: SANITIZE_WHITESPACE_TRIM
                                   | SANITIZE_TO_LOWER,
                arraySeparator: ","
            ),
            "website" => new ValidationOptions(),
            "email" => new ValidationOptions(),
            "phoneNumber" => new ValidationOptions(),
            "isPaid" => new ValidationOptions(sanitizationFlags: SANITIZE_TO_UPPER | SANITIZE_WHITESPACE_REMOVE),
            "logoFile" => new ValidationOptions(),
        ];
    }
}
