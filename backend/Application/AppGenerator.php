<?php

declare(strict_types=1);

namespace Internships\Application;

use Internships\Factories\CompanyDataFactory;
use Internships\Factories\DataFactory;
use Internships\Factories\FacultyDataFactory;
use Internships\Factories\FetchAddressFactory;
use Internships\FileSystem\FileManager;
use Internships\FileSystem\Path;
use Internships\Helpers\OutputWriter;
use Internships\Services\CsvReader;

class AppGenerator
{
    /** @var DataFactory[] */
    protected array $subFactories;

    public function __construct(
        protected FileManager $fileManager,
        protected CsvReader $csvReader,
        protected FacultyDataFactory $facultyFactory,
        protected FetchAddressFactory $fetchAddressFactory,
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
                $companies = $this->csvReader->getCSVData(
                    resourceRelativePath: "/faculties/{$faculty->getDirectory()}",
                    fileName: "companies.csv",
                    fieldDefines: $this->subFactories["company"]->getFields()
                );
                $data = $this->fetchAddressFactory->buildFromData($companies);
                echo "v";
        }
    }
}
