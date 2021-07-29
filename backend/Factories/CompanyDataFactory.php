<?php

declare(strict_types=1);

namespace Internships\Factories;

use Internships\Collectors\FilterMainCollector;
use Internships\FileSystem\FileManager;
use Internships\Interfaces\SerializableInfo;
use Internships\Models\Company;
use Internships\Models\ValidationOptions;
use Internships\Services\DataValidator;

class CompanyDataFactory extends DataFactory implements SerializableInfo
{
    protected FilterMainCollector $filterCollector;

    public function __construct(FileManager $fileManager, DataValidator $dataValidator)
    {
        $this->filterCollector = new FilterMainCollector($fileManager);
        parent::__construct($dataValidator);
    }

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
            "zip" => new ValidationOptions(required: true),
            "city" => new ValidationOptions(
                required: true,
                sanitizationFlags: SANITIZE_WHITESPACE_TRIM
                          | SANITIZE_CAPITALIZE_WORDS
            ),
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
            "socialsFacebook" => new ValidationOptions(),
            "socialsLinkedIn" => new ValidationOptions(),
        ];
    }

    public function processEntry(int $entryId, array $entry): array
    {
        $entry["country"] = $this->filterCollector->getCountryCollector()->collectAndGetID($entry["country"], $entryId);
        $entry["city"] = $this->filterCollector->getCityCollector()->collectAndGetID($entry["city"], $entryId);

        $entry["specialization"] = $this->filterCollector->getSpecializationCollector()->collectAndGetID(
            $entry["specialization"],
            $entryId
        );

        $tagIds = [];
        $tagCollector = $this->filterCollector->getTagCollector();
        foreach ($entry["tags"] as $tag) {
            $currentTagId = $tagCollector->collectAndGetID($tag, $entryId);
            array_push($tagIds, $tagCollector->collectAndGetID($tag, $entryId));
            $this->filterCollector->getSpecializationCollector()
                ->getLastUsedElement()
                ->pushRelatedChildId($currentTagId);
        }

        $entry["tags"] = array_unique($tagIds, SORT_NUMERIC);

        return $entry;
    }

    public function onBuildStart(): void
    {
        $this->filterCollector->rebuild();
    }

    public function onBuildEnd(): void
    {
        $this->filterCollector->saveToJson($this->workingDirectory);
    }
}
