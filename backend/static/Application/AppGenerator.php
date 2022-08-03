<?php

declare(strict_types=1);

namespace InternshipsStatic\Application;

use InternshipsStatic\CommandLine\ConsoleWriter;
use InternshipsStatic\Exceptions\Validation\IsMissingValidationException;
use InternshipsStatic\Factories\CompanyDataFactory;
use InternshipsStatic\Factories\DataFactory;
use InternshipsStatic\Factories\DocumentConfigFactory;
use InternshipsStatic\Factories\FacultyDataFactory;
use InternshipsStatic\Factories\FetchAddressDataFactory;
use InternshipsStatic\FileSystem\FileManager;
use InternshipsStatic\Models\Faculty;
use InternshipsStatic\Models\FetchAddress;
use InternshipsStatic\Services\CoordinateFetcher;
use InternshipsStatic\Services\CsvReader;

class AppGenerator
{
    /** @var array<DataFactory> */
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
            $factory->getFields(),
        );
        return $factory->buildFromData($facultyCsvData, serializeSubData: true);
    }

    public function saveDataToJson(DataFactory $factory, array $data): void
    {
        $this->fileManager->create(
            relativePathIdentity: $factory->getRelativePathIdentity(),
            content: json_encode($data, $this->fileManager->getDefaultJsonFlags()),
            toResource: false,
        );
    }

    public function generateStaticData(): void
    {
        /** @var array<Faculty> $faculties */
        $faculties = $this->getDataFromCsv($this->facultyFactory);
        $this->saveDataToJson($this->facultyFactory, $faculties);
        try {
            foreach ($faculties as $faculty) {
                ConsoleWriter::print("Processing {$faculty->getDirectory()}");
                $this->facultyFactory->changeDirectory($faculty->getDirectory());
                foreach ($this->subFactories as $subFactory) {
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
        /** @var array<Faculty> $faculties */
        $faculties = $this->getDataFromCsv($this->facultyFactory);
        $facultyTemplatePaths = $this->fileManager->getResourceFilePathsFrom(
            relativeOrigin: "/templates/faculty-directory/",
        );

        foreach ($faculties as $rowNumber => $faculty) {
            $relativePathIdentity = $this->facultyFactory->getRelativePathIdentity();
            $relativePathIdentity->setChangingPath($faculty->getDirectory());
            if ($rowNumber > 0) {
                $this->fileManager->copyResources($facultyTemplatePaths, $relativePathIdentity);
            }
        }
    }

    public function getMissingCoordinatesForCompanies(): void
    {
        /** @var array<Faculty> $faculties */
        $faculties = $this->getDataFromCsv($this->facultyFactory);
        foreach ($faculties as $faculty) {
            $fetchFactory = $this->fetchAddressFactory;
            $this->facultyFactory->changeDirectory($faculty->getDirectory());
            $fetchFactory->getRelativePathIdentity()
                ->setParentIdentity($this->facultyFactory->getRelativePathIdentity());

            $companyPathIdentity = $fetchFactory->getRelativePathIdentity();
            $fields = $fetchFactory->getFields();

            $companies = $this->csvReader->getCsvData(
                relativePathIdentity: $companyPathIdentity,
                fieldDefines: $fields,
            );

            /** @var array<FetchAddress> $addresses */
            $addresses = $fetchFactory->buildFromData($companies);
            $requiresSave = false;

            foreach ($addresses as $address) {
                if ($address->getRawCoordinates() !== "") {
                    continue;
                }

                $csvRow = $address->getId() + 1;
                ConsoleWriter::print(
                    message: "Trying to fetch coordinates for {$companies[$csvRow]["name"]}.",
                );

                $requiresSave = $this->geocoder->coordinatesFromAddress(
                    currentCoordinates: $companies[$csvRow]["coordinates"],
                    addressObject: $address,
                ) || $requiresSave;
            }

            if ($requiresSave) {
                $this->csvReader->saveData(
                    relativePathIdentity: $companyPathIdentity,
                    data: $companies,
                );
                ConsoleWriter::success("Saved {$companyPathIdentity->getSourceName()} for faculty {$faculty->getName()}.");
            } else {
                ConsoleWriter::print("No coordinates were fetched for faculty {$faculty->getName()}.");
            }
        }
    }
}
