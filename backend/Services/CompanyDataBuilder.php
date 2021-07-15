<?php

declare(strict_types=1);

namespace Internships\Services;

use Internships\Interfaces\SerializableInfo;
use Internships\Models\Company;
use Internships\Models\PathPair;
use Internships\Models\ValidationOptions;

class CompanyDataBuilder extends DataBuilder implements SerializableInfo
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

    public function buildFromData(array $csvData): array
    {
        $companies = [];
        foreach ($csvData as $rowNumber => $rowData) {
            if ($rowNumber > 0) {
                $entry = array_combine(array_keys($this->fields), array_values($rowData));
                $offsetRowNumber = $rowNumber - 1;
                array_push(
                    $companies,
                    new Company(
                        $offsetRowNumber,
                        $this->validate($offsetRowNumber, $entry)
                    )
                );
            }
        }
        return $companies;
    }
}
