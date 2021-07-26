<?php

declare(strict_types=1);

namespace Internships\Application;

use Internships\FileSystem\FileManager;
use Internships\FileSystem\Path;
use Internships\Helpers\OutputWriter;
use Internships\Services\CompanyDataFactory;
use Internships\Services\CsvReader;
use Internships\Services\DataFactory;
use Internships\Services\FacultyDataFactory;

class AppGenerator
{
    protected array $subFactories;

    public function __construct(
        protected FileManager $fileManager,
        protected CsvReader $csvReader,
        protected FacultyDataFactory $facultyFactory,
        CompanyDataFactory $companyDataFactory,
    ) {
        $this->subFactories = [
            $companyDataFactory,
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
        foreach ($faculties as $faculty) {
            $this->fileManager->copyResources(
                "{$source}/faculty-directory/",
                $destination . Path::FOLDER_SEPARATOR . $faculty->getDirectory(),
                $facultyTemplatePaths
            );
        }
    }
}
