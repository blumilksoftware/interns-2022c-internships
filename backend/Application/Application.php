<?php

declare(strict_types=1);

namespace Internships\Application;

use Internships\FileSystem\FileManager;
use Internships\FileSystem\Path;
use Internships\Services\FacultyDataFactory;

class Application
{
    public function __construct(
        protected FileManager $fileManager,
        protected AppGenerator $appGenerator,
        protected FacultyDataFactory $facultyFactory,
    ) {
    }

    public function build(): void
    {
        echo "Building static site..." . PHP_EOL;
        echo "Reading faculties." . PHP_EOL;
        $facultyData = $this->appGenerator->getDataFromCsv($this->facultyFactory);
        echo "Saving faculties to .json." . PHP_EOL;
        $this->appGenerator->saveDataToJson($this->facultyFactory, $facultyData);
        echo "Reading and saving data from each faculty..." . PHP_EOL;
        $this->appGenerator->generateFromFaculties($facultyData);
    }

    public function populate(): void
    {
        echo "Generating resource files..." . PHP_EOL;
        $source = "/templates/faculty-directory/";
        $destination = "/faculties/";

        $facultyCsvData = $this->appGenerator->getDataFromCsv($this->facultyFactory);
        $templatePaths = $this->fileManager->getResourceFilePathsFrom($source);

        foreach ($facultyCsvData as $rowNumber => $faculty) {
            if ($rowNumber > 0) {
                $this->fileManager->copyResources(
                    $source,
                    $destination . Path::FOLDER_SEPARATOR . $faculty->getDirectory(),
                    $templatePaths
                );
            }
        }
    }
}
