<?php

declare(strict_types=1);

namespace Internships\Application;

use Exception;
use Internships\Factories\CompanyDataFactory;
use Internships\Factories\DataFactory;
use Internships\Factories\FacultyDataFactory;
use Internships\Factories\FetchAddressDataFactory;
use Internships\FileSystem\FileManager;
use Internships\FileSystem\Path;
use Internships\Helpers\OutputWriter;
use Internships\Models\FetchAddress;
use Internships\Services\CsvReader;
use Internships\Services\Geocoder;

class AppGenerator
{
    /** @var DataFactory[] */
    protected array $subFactories;

    public function __construct(
        protected FileManager $fileManager,
        protected CsvReader $csvReader,
        protected Geocoder $geocoder,
        protected FacultyDataFactory $facultyFactory,
        protected FetchAddressDataFactory $fetchAddressFactory,
        CompanyDataFactory $companyDataFactory,
    ) {
        $this->subFactories = [
            "company" => $companyDataFactory,
        ];
    }

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
        $this->fileManager->create(
            $factory->getDestinationRelativePath(),
            $factory->getDestinationFileName(),
            json_encode($data, $this->fileManager->getDefaultJsonFlags())
        );
    }

    public function generateStaticData(): void
    {
        $faculties = $this->getDataFromCsv($this->facultyFactory);
        $this->saveDataToJson($this->facultyFactory, $faculties);
        foreach ($faculties as $faculty) {
            foreach ($this->subFactories as $subFactory) {
                OutputWriter::newLineToConsole("Processing {$faculty->getDirectory()}");
                $subFactory->setDirectory("/faculties/{$faculty->getDirectory()}");
                $data = $this->getDataFromCsv($subFactory);
                $this->saveDataToJson($subFactory, $data);
            }
        }
    }

    public function generateResourceContents(): void
    {
        $source = "/templates/";
        $destination = "/faculties/";

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
        $faculties = $this->getDataFromCsv($this->facultyFactory);

        foreach ($faculties as $faculty) {
            $fields = $this->subFactories["company"]->getFields();
            $companies = $this->csvReader->getCSVData(
                resourceRelativePath: "/faculties/{$faculty->getDirectory()}",
                fileName: "companies.csv",
                fieldDefines: $fields
            );

            /* @var FetchAddress[] $addresses */
            $addresses = $this->fetchAddressFactory->buildFromData($companies);
            foreach ($addresses as $address) {
                if ($address->getRawCoordinates() == "") {
                    $csvRow = $address->getId() + 1;
                    try {
                        $rawCoordinates = $this->geocoder->coordinatesFromAddress(addressObject: $address);
                        $companies[$csvRow]["coordinates"] = $rawCoordinates;
                    } catch (Exception $exception) {
                        OutputWriter::newLineToConsole($exception->getMessage());
                        OutputWriter::newLineToConsole(
                            "Couldn't fetch coordinates for {$companies[$csvRow]["name"]}."
                            . " Check address or insert coordinates manually."
                            . " Skipping..."
                        );
                    }
                }
            }
        }
    }
}
