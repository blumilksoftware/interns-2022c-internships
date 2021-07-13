<?php

declare(strict_types=1);

namespace Internships\Application;

use Internships\FileSystem\CsvReader;
use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;
use Internships\Services\CompanyBuilder;
use Internships\Services\FacultyBuilder;

class Application
{
    protected DirectoryManager $directoryManager;
    protected FileManager $fileManager;
    protected CsvReader $csvReader;
    protected FacultyBuilder $facultyBuilder;
    protected array $childBuilders;

    public function __construct(
        string $rootPath,
        string $apiRelativePath,
        string $resourceRelativePath
    ) {
        $this->directoryManager = new DirectoryManager($rootPath, $apiRelativePath, $resourceRelativePath);
        $this->fileManager = new FileManager($this->directoryManager);
        $this->csvReader = new CsvReader();
        $this->facultyBuilder = new FacultyBuilder("/faculties/");
        $this->childBuilders = [
            new CompanyBuilder(""),
        ];
    }

    public function build(): void
    {
        $jsonPrintFlags = JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT;
        $facultyCsvData = $this->csvReader->getCSVData(
            $this->directoryManager->getResourcePath($this->facultyBuilder->getSource()->getRelativePath())
            . $this->facultyBuilder->getSource()->getFileName()
        );
        $faculties = $this->facultyBuilder->buildFromData($facultyCsvData);
        $this->fileManager->create(
            $this->facultyBuilder->getDestination()->getRelativePath(),
            $this->facultyBuilder->getDestination()->getFileName(),
            json_encode($faculties, $jsonPrintFlags)
        );

        foreach ($faculties as $faculty) {
            foreach ($this->childBuilders as $builder) {
                $builder->setWorkingDirectory("/faculties/" . $faculty->getDirectory());
                $csvData = $this->csvReader->getCSVData(
                    $this->directoryManager->getResourcePath($builder->getSource()->getRelativePath())
                    . $builder->getSource()->getFileName()
                );
                $buildData = $builder->buildFromData($csvData);
                $this->fileManager->create(
                    $builder->getDestination()->getRelativePath(),
                    $builder->getDestination()->getFileName(),
                    json_encode($buildData, $jsonPrintFlags)
                );
            }
        }
        /*
        $data = $this->csvReader->getCSVData(
            $this->directoryManager->getResourcePath("/faculties/") . "faculties.csv"
        );
        $this->fileManager->create(
            "/wydzial-techniczny",
            "companies.json",
            json_encode(Company::getCompaniesFromData($data), $jsonPrintFlags)
        );
        */
    }
}
