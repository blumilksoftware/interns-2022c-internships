<?php

declare(strict_types=1);

namespace Internships\Application;

use DI\Container;
use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;
use Internships\FileSystem\Path;
use Internships\Services\CompanyDataBuilder;
use Internships\Services\CsvReader;
use Internships\Services\FacultyDataBuilder;
use Internships\Services\UniquePathGuard;

class Application
{
    protected int $jsonPrintFlags = JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES;

    public function __construct(
        protected DirectoryManager $directoryManager,

    ) {
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
