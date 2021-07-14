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

    public function buildFromData(array $csvData): array
    {
        $companies = [];
        foreach ($csvData as $i => $rowData) {
            if ($i > 0) {
                $entry = [
                    "name" => $rowData[0],
                    "country" => $rowData[1],
                    "coordinates" => $rowData[2],
                    "street" => $rowData[3],
                    "city" => $rowData[4],
                    "zip" => $rowData[5],
                    "specialization" => $rowData[6],
                    "tags" => $rowData[7],
                    "website" => $rowData[8],
                    "email" => $rowData[9],
                    "phoneNumber" => $rowData[10],
                    "isPaid" => $rowData[11],
                    "logoFile" => $rowData[12],
                ];
                array_push($companies, new Company($i - 1, $this->validate($i - 1, $entry)));
            }
        }
        return $companies;
    }

    public function validate(int $id, array $entry): array
    {
        $entry["name"] = $this->validateField($entry["name"], "Name", $id, true);

        $entry["country"] = $this->validateField(
            $entry["country"],
            "country",
            $id,
            true,
            SANITIZE_WHITESPACE_TRIM
            | SANITIZE_CAPITALIZE_WORDS,
        );

        $entry["coordinates"] = $this->validateField(
            $entry["coordinates"],
            "coordinates",
            $id,
            true,
            SANITIZE_WHITESPACE_REMOVE,
            ",",
            6
        );

        $entry["street"] = $this->validateField($entry["street"], "street", $id, true);

        $entry["city"] = $this->validateField(
            $entry["city"],
            "city",
            $id,
            true,
            SANITIZE_WHITESPACE_TRIM
            | SANITIZE_CAPITALIZE_WORDS
        );

        $entry["zip"] = $this->validateField($entry["zip"], "zip", $id, true);

        $entry["specialization"] = $this->validateField(
            $entry["specialization"],
            "specialization",
            $id,
            true,
            SANITIZE_WHITESPACE_TRIM
            | SANITIZE_CAPITALIZE_WORDS
        );

        $entry["tags"] = $this->validateField(
            $entry["tags"],
            "tags",
            $id,
            false,
            SANITIZE_WHITESPACE_TRIM
            | SANITIZE_TO_LOWER,
            ","
        );

        $entry["website"] = $this->validateField($entry["website"], "website", $id);
        $entry["email"] = $this->validateField($entry["email"], "email", $id);
        $entry["phoneNumber"] = $this->validateField($entry["phoneNumber"], "phoneNumber", $id);
        $entry["isPaid"] = false;
        $entry["logoFile"] = $this->validateField($entry["logoFile"], "logoFile", $id);
        return $entry;
    }
}
