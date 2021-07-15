<?php

declare(strict_types=1);

namespace Internships\Application;

use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;
use Internships\Services\CompanyDataBuilder;
use Internships\Services\CsvReader;
use Internships\Services\FacultyDataBuilder;
use Internships\Services\UniquePathGuard;

class Application
{
    protected UniquePathGuard $pathGuard;
    protected DirectoryManager $directoryManager;
    protected FileManager $fileManager;
    protected CsvReader $csvReader;
    protected FacultyDataBuilder $facultyBuilder;
    protected array $csvBuilders;

    public function __construct(
        string $rootPath,
        string $apiRelativePath,
        string $resourceRelativePath
    ) {
        $this->pathGuard = new UniquePathGuard();
        $this->directoryManager = new DirectoryManager($rootPath, $apiRelativePath, $resourceRelativePath);
        $this->fileManager = new FileManager($this->directoryManager);
        $this->csvReader = new CsvReader();
        $this->facultyBuilder = new FacultyDataBuilder(
            "/",
            $this->pathGuard->createPathPair(
                "/faculties/",
                "faculties.csv"
            ),
            $this->pathGuard->createPathPair(
                "/faculties/",
                "faculties.json"
            )
        );
        $this->csvBuilders = [
            new CompanyDataBuilder(
                "/",
                $this->pathGuard->createPathPair(
                    "",
                    "companies.csv"
                ),
                $this->pathGuard->createPathPair(
                    "",
                    "companies.json"
                )
            ),
        ];
    }

    public function build(): void
    {
        $jsonPrintFlags = JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES;
        $facultyCsvData = $this->csvReader->getCSVData(
            $this->directoryManager->getResourceFilePath(
                $this->facultyBuilder->getSourceRelativePath(),
                $this->facultyBuilder->getSourceFileName()),
            $this->facultyBuilder->getFields()
        );

        $faculties = $this->facultyBuilder->buildFromData($facultyCsvData);
        $this->fileManager->create(
            $this->facultyBuilder->getDestinationRelativePath(),
            $this->facultyBuilder->getDestinationFileName(),
            json_encode($faculties, $jsonPrintFlags)
        );

        foreach ($faculties as $faculty) {
            foreach ($this->csvBuilders as $builder) {
                $builder->setDirectory("/faculties/" . $faculty->getDirectory());
                $csvData = $this->csvReader->getCSVData(
                    $this->directoryManager->getResourceFilePath(
                        $builder->getSourceRelativePath(),
                        $builder->getSourceFileName()
                    ),
                    $builder->getFields()
                );

                $buildData = $builder->buildFromData($csvData);
                $this->fileManager->create(
                    $builder->getDestinationRelativePath(),
                    $builder->getDestinationFileName(),
                    json_encode($buildData, $jsonPrintFlags)
                );
            }
        }
    }
}
