<?php

declare(strict_types=1);

namespace Internships\Application;

use Internships\Exceptions\Validation\IsMissingValidationException;
use Internships\Factories\CompanyDataFactory;
use Internships\Factories\DataFactory;
use Internships\Factories\DocumentConfigFactory;
use Internships\Factories\FacultyDataFactory;
use Internships\Factories\FetchAddressDataFactory;
use Internships\FileSystem\FileManager;
use Internships\FileSystem\Path;
use Internships\Helpers\OutputWriter;
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

    public function getDataFromCsv(DataFactory $factory): array
    {
        $facultyCsvData = $this->csvReader->getCSVData(
            $factory->getSourceRelativePath(),
            $factory->getSourceFileName(),
            $factory->getFields()
        );
        return $factory->buildFromData($facultyCsvData, serializeSubData: true);
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
                OutputWriter::newLineToConsole("Processing {$faculty->getDirectory()}");
                foreach ($this->subFactories as $subFactory) {
                    $subFactory->setDirectory(
                        "{$this->facultyFactory->getBaseSourcePath()}{$faculty->getDirectory()}"
                    );
                    $data = $this->getDataFromCsv($subFactory);
                    $this->saveDataToJson($subFactory, $data);
                }
            }
        } catch (IsMissingValidationException $exception) {
            OutputWriter::newLineToConsole($exception->getMessage());
            if ($exception->getFieldName() === "coordinates") {
                OutputWriter::newLineToConsole("Consider using 'composer fetch' to get missing entries.");
            }
            die();
        }
    }

    public function generateResourceContents(): void
    {
        $source = "/templates/";
        $destination = $this->facultyFactory->getBaseDestinationPath();

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
        $basePath = $this->facultyFactory->getBaseSourcePath();
        $sourceFilename = $this->subFactories["company"]->getSourceFileName();

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
                OutputWriter::newLineToConsole(
                    text: "Trying to fetch coordinates for {$companies[$csvRow]["name"]}."
                );

                $requiresSave = $this->geocoder->coordinatesFromAddress(
                    currentCoordinates: $companies[$csvRow]["coordinates"],
                    addressObject: $address
                ) || $requiresSave;
            }

            if ($requiresSave) {
                OutputWriter::newLineToConsole("Saving {$sourceFilename} for faculty {$faculty->getName()}.");
                $this->csvReader->saveData(
                    resourceRelativePath: $basePath . $faculty->getDirectory(),
                    fileName: $sourceFilename,
                    data: $companies
                );
            } else {
                OutputWriter::newLineToConsole("No coordinates were fetched for faculty {$faculty->getName()}.");
            }
        }
    }
}
