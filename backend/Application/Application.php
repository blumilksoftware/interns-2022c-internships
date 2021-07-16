<?php

declare(strict_types=1);

namespace Internships\Application;

use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;
use Internships\FileSystem\Path;
use Internships\Services\CompanyDataBuilder;
use Internships\Services\CsvReader;
use Internships\Services\FacultyDataBuilder;
use Internships\Services\UniquePathGuard;

class Application
{
    protected int $jsonPrintFlags;
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
        $this->jsonPrintFlags = JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
            | JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES;
        $this->pathGuard = new UniquePathGuard();
        $this->directoryManager = new DirectoryManager($rootPath, $apiRelativePath, $resourceRelativePath);
        $this->fileManager = new FileManager($this->directoryManager);
        $this->csvReader = new CsvReader();
        $this->facultyBuilder = new FacultyDataBuilder(
            "",
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
                "",
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
        echo "Building static site..." . PHP_EOL;
        $facultyCsvData = $this->csvReader->getCSVData(
            $this->directoryManager->getResourceFilePath(
                $this->facultyBuilder->getSourceRelativePath(),
                $this->facultyBuilder->getSourceFileName()
            ),
            $this->facultyBuilder->getFields()
        );

        $faculties = $this->facultyBuilder->buildFromData($facultyCsvData);
        $this->fileManager->create(
            $this->facultyBuilder->getDestinationRelativePath(),
            $this->facultyBuilder->getDestinationFileName(),
            json_encode($faculties, $this->jsonPrintFlags)
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
                    json_encode($buildData, $this->jsonPrintFlags)
                );
            }
        }
    }

    public function populate(): void
    {
        echo "Generating resource files..." . PHP_EOL;
        $source = "/templates/faculty-directory/";
        $destination = "/faculties/";

        $facultyCsvData = $this->csvReader->getCSVData(
            $this->directoryManager->getResourceFilePath(
                $this->facultyBuilder->getSourceRelativePath(),
                $this->facultyBuilder->getSourceFileName()
            ),
            $this->facultyBuilder->getFields()
        );
        $templatePaths = $this->fileManager->getResourceFilePathsFrom($source);
        foreach ($facultyCsvData as $rowNumber => $faculty) {
            if ($rowNumber > 0) {
                $this->fileManager->copyResources(
                    $source,
                    $destination . Path::FOLDER_SEPARATOR . $faculty[1],
                    $templatePaths
                );
            }
        }
    }
}
