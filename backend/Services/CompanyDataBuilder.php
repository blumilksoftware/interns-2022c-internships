<?php

declare(strict_types=1);

namespace Internships\Services;

use Internships\Interfaces\SerializableInfo;
use Internships\Models\Company;
use Internships\Models\PathPair;

class CompanyDataBuilder extends DataBuilder implements SerializableInfo
{
    public function __construct(
        string $workingDirectory,
        PathPair $source,
        Pathpair $destination
    ) {
        parent::__construct($workingDirectory, $source, $destination);
    }

    public function defineDataFields()
    {
        $this->fields = array(
            "name",
            "country",
            "coordinates",
            "street",
            "city",
            "zip",
            "specialization",
            "tags",
            "website",
            "email",
            "phoneNumber",
            "isPaid",
            "logoFile",
        );
    }

    public function buildFromData(array $csvData): array
    {
        $companies = [];
        foreach ($csvData as $rowNumber => $rowData) {
            if ($rowNumber > 0) {
                $entry = array_combine($this->fields, $rowData);
                $offsetRowNumber = $rowNumber - 1;
                array_push($companies, new Company($offsetRowNumber,
                                                   $this->validate($offsetRowNumber, $entry)));
            }
        }
        return $companies;
    }

    public function validate(int $entryID, array $entry): array
    {
        $entry["name"] = $this->dataValidator->validateField(
            $entry["name"],
            $entryID,
            fieldName: "name",
            required: true
        );

        $entry["country"] = $this->dataValidator->validateField(
            $entry["country"],
            $entryID,
            fieldName: "country",
            required: true,
            sanitizationFlags: SANITIZE_WHITESPACE_TRIM
            | SANITIZE_CAPITALIZE_WORDS,
        );

        $entry["coordinates"] = $this->dataValidator->validateField(
            $entry["coordinates"],
            $entryID,
            fieldName: "coordinates",
            required: true,
            sanitizationFlags: SANITIZE_WHITESPACE_REMOVE,
            arraySeparator: ",",
            maxDecimals: 6,
            expectedCount: 2
        );

        $entry["street"] = $this->dataValidator->validateField(
            $entry["street"],
            $entryID,
            fieldName: "street",
            required: true
        );

        $entry["city"] = $this->dataValidator->validateField(
            $entry["city"],
            $entryID,
            fieldName: "city",
            required: true,
            sanitizationFlags: SANITIZE_WHITESPACE_TRIM
            | SANITIZE_CAPITALIZE_WORDS
        );

        $entry["zip"] = $this->dataValidator->validateField(
            $entry["zip"],
            $entryID,
            fieldName: "zip",
            required: true
        );

        $entry["specialization"] = $this->dataValidator->validateField(
            $entry["specialization"],
            $entryID,
            fieldName: "specialization",
            required: true,
            sanitizationFlags: SANITIZE_WHITESPACE_TRIM
            | SANITIZE_CAPITALIZE_WORDS
        );

        $entry["tags"] = $this->dataValidator->validateField(
            fieldValue: $entry["tags"],
            fieldName: "tags",
            entryID: $entryID,
            sanitizationFlags: SANITIZE_WHITESPACE_TRIM
                        | SANITIZE_TO_LOWER,
            arraySeparator: ","
        );

        $entry["website"] = $this->dataValidator->validateField(
            $entry["website"],
            $entryID,
            fieldName: "website",
        );
        $entry["email"] = $this->dataValidator->validateField(
            $entry["email"],
            $entryID,
            fieldName: "email",
        );
        $entry["phoneNumber"] = $this->dataValidator->validateField(
            $entry["phoneNumber"],
            $entryID,
            fieldName: "phoneNumber",
        );
        $entry["isPaid"] = false;
        $entry["logoFile"] = $this->dataValidator->validateField(
            $entry["logoFile"],
            $entryID,
            fieldName: "logoFile",
        );
        return $entry;
    }
}