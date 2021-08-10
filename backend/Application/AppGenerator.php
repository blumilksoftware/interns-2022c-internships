<?php

declare(strict_types=1);

namespace Internships\Application;

use Internships\CommandLine\ConsoleWriter;
use Internships\Exceptions\Validation\IsMissingValidationException;
use Internships\Factories\CompanyDataFactory;
use Internships\Factories\DataFactory;
use Internships\Factories\DocumentConfigFactory;
use Internships\Factories\FacultyDataFactory;
use Internships\Factories\FetchAddressDataFactory;
use Internships\FileSystem\FileManager;
use Internships\FileSystem\Path;
use Internships\Models\Faculty;
use Internships\Models\FetchAddress;
use Internships\Services\CoordinateFetcher;
use Internships\Services\CsvReader;

class AppGenerator
{
    /** @var DataFactory[] */
    protected array $subFactories;

    public function __construct(
        protected FileManager $fileManager,
        protected CsvReader $csvReader,
        protected CoordinateFetcher $geocoder,
        protected FacultyDataFactory $facultyFactory,
        protected FetchAddressDataFactory $fetchAddressFactory,
        CompanyDataFactory $companyDataFactory,
        DocumentConfigFactory $documentConfigFactory,
    ) {
        $this->subFactories = [
            "company" => $companyDataFactory,
            "document" => $documentConfigFactory,
        ];
    }

    /**
     * @throws IsMissingValidationException
     */
    public function getDataFromCsv(DataFactory $factory): array
    {
        $facultyCsvData = $this->csvReader->getCSVData(
            $factory->getSourceRelativePath(),
            $factory->getSourceFileName(),
            $factory->getFields()
        );
        return $factory->buildFromData($facultyCsvData);
    }

    public function saveDataToJson(DataFactory $factory, array $data): void
    {
        $this->fileManager->createInApi(
            $factory->getDestinationRelativePath(),
            $factory->getDestinationFileName(),
            json_encode($data, $this->fileManager->getDefaultJsonFlags())
        );
    }

    public function generateStaticData(): void
    {
        /** @var Faculty[] $faculties */
        $faculties = $this->getDataFromCsv($this->facultyFactory);
        $this->saveDataToJson($this->facultyFactory, $faculties);
        try {
            foreach ($faculties as $faculty) {
                foreach ($this->subFactories as $subFactory) {
                    ConsoleWriter::print("Processing {$faculty->getDirectory()}.");
                    $subFactory->setDirectory("/faculties/{$faculty->getDirectory()}");
                    $data = $this->getDataFromCsv($subFactory);
                    $this->saveDataToJson($subFactory, $data);
                }
            }
        } catch (IsMissingValidationException $exception) {
            ConsoleWriter::print($exception->getMessage());
            if ($exception->getFieldName() === "coordinates") {
                ConsoleWriter::warn("Consider using 'composer fetch' to get missing entries.");
            }
            die();
        }
    }

    public function generateResourceContents(): void
    {
        $source = "/templates/";
        $destination = "/faculties/";

        /** @var Faculty[] $faculties */
        $faculties = $this->getDataFromCsv($this->facultyFactory);

        $facultyTemplatePaths = $this->fileManager->getResourceFilePathsFrom("{$source}/faculty-directory/");
        foreach ($faculties as $rowNumber => $faculty) {
            if ($rowNumber > 0) {
                $this->fileManager->copyResources(
                    "{$source}/faculty-directory/",
                    $destination . Path::FOLDER_SEPARATOR . $faculty->getDirectory(),
                    $facultyTemplatePaths
                );
            }
        }
    }

    public function getMissingCoordinatesForCompanies(): void
    {
        $basePath = "/faculties/";
        $sourceFilename = "companies.csv";

        /** @var Faculty[] $faculties */
        $faculties = $this->getDataFromCsv($this->facultyFactory);
        foreach ($faculties as $faculty) {
            $fields = $this->subFactories["company"]->getFields();
            $companies = $this->csvReader->getCSVData(
                resourceRelativePath: $basePath . $faculty->getDirectory(),
                fileName: $sourceFilename,
                fieldDefines: $fields
            );

            /** @var FetchAddress[] $addresses */
            $addresses = $this->fetchAddressFactory->buildFromData($companies);
            $requiresSave = false;

            foreach ($addresses as $address) {
                if ($address->getRawCoordinates() !== "") {
                    continue;
                }

                $csvRow = $address->getId() + 1;
                ConsoleWriter::print(
                    message: "Trying to fetch coordinates for {$companies[$csvRow]["name"]}."
                );

                $requiresSave = $this->geocoder->coordinatesFromAddress(
                    currentCoordinates: $companies[$csvRow]["coordinates"],
                    addressObject: $address
                ) || $requiresSave;
            }

            if ($requiresSave) {
                $this->csvReader->saveData(
                    resourceRelativePath: $basePath . $faculty->getDirectory(),
                    fileName: $sourceFilename,
                    data: $companies
                );
                ConsoleWriter::success("Saved {$sourceFilename} for faculty {$faculty->getName()}.");
            } else {
                ConsoleWriter::print("No coordinates were fetched for faculty {$faculty->getName()}.");
            }
        }
    }
}
