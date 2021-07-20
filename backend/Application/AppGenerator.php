<?php

declare(strict_types=1);

namespace Internships\Application;

use Internships\FileSystem\FileManager;
use Internships\Services\CompanyDataFactory;
use Internships\Services\CsvReader;
use Internships\Services\DataFactory;

class AppGenerator
{
    protected array $subFactories;

    public function __construct(
        protected FileManager $fileManager,
        protected CsvReader $csvReader,
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

    public function generateFromFaculties(array $faculties): void
    {
        foreach ($faculties as $faculty) {
            foreach ($this->subFactories as $subFactory) {
                echo "Processing " . $faculty->getDirectory() . "." . PHP_EOL;
                $subFactory->setDirectory("/faculties/" . $faculty->getDirectory());
                $data = $this->getDataFromCsv($subFactory);
                $this->saveDataToJson($subFactory, $data);
            }
        }
    }
}
