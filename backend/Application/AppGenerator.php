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

        foreach ($this->subFactories as $subFactory) {
            $subFactory->getRelativePathIdentity()
                ->setParentIdentity($facultyFactory->getRelativePathIdentity());
        }
    }

    /**
     * @throws IsMissingValidationException
     */
    public function getDataFromCsv(DataFactory $factory): array
    {
        $facultyCsvData = $this->csvReader->getCsvData(
            $factory->getRelativePathIdentity(),
            $factory->getFields()
        );
        return $factory->buildFromData($facultyCsvData);
    }

    public function saveDataToJson(DataFactory $factory, array $data): void
    {
        $this->fileManager->create(
            relativePathIdentity: $factory->getRelativePathIdentity(),
            content: json_encode($data, $this->fileManager->getDefaultJsonFlags()),
            toResource: false
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
                $this->facultyFactory->changeDirectory($faculty->getDirectory());
                foreach ($this->subFactories as $subFactory) {
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
        /** @var Faculty[] $faculties */
        $faculties = $this->getDataFromCsv($this->facultyFactory);

        $facultyTemplatePaths = $this->fileManager->getResourceFilePathsFrom("/templates/faculty-directory/");
        foreach ($faculties as $rowNumber => $faculty) {
            $relativePathIdentity = $this->facultyFactory->getRelativePathIdentity();
            $relativePathIdentity->setChangingPathPart($faculty->getDirectory());
            if ($rowNumber > 0) {
                $this->fileManager->copyResources($facultyTemplatePaths, $relativePathIdentity);
            }
        }
    }

    public function getMissingCoordinatesForCompanies(): void
    {
        /** @var Faculty[] $faculties */
        $faculties = $this->getDataFromCsv($this->facultyFactory);
        foreach ($faculties as $faculty) {
            $this->facultyFactory->changeDirectory($faculty->getDirectory());
            $companyPathIdentity = $this->subFactories["company"]->getRelativePathIdentity();
            $fields = $this->subFactories["company"]->getFields();

            $companies = $this->csvReader->getCsvData(
                relativePathIdentity: $companyPathIdentity,
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
                OutputWriter::newLineToConsole("Saving {$companyPathIdentity->getSourceName()}"
                                               . " for faculty {$faculty->getName()}.");
                $this->csvReader->saveData(
                    relativePathIdentity: $companyPathIdentity,
                    data: $companies
                );
            } else {
                OutputWriter::newLineToConsole("No coordinates were fetched for faculty {$faculty->getName()}.");
            }
        }
    }
}
