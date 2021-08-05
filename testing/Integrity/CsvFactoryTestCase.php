<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\Factories\DataFactory;
use Internships\FileSystem\FileManager;
use Internships\FileSystem\Path;
use Internships\Services\CsvReader;
use Internships\Services\DataSanitizer;
use Internships\Services\DataValidator;
use Internships\Services\UniquePathGuard;

class CsvFactoryTestCase extends GenericResourceTestCase
{
    protected FileManager $fileManager;
    protected CsvReader $csvReader;
    protected DataFactory $dataFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fileManager = new FileManager($this->directoryManager, new UniquePathGuard());
        $this->validator = new DataValidator(new DataSanitizer());
    }

    public function testIfRelatedFilesExist(): void
    {
        $factoryName = $this->dataFactory::class;
        $files = $this->fileManager->getResourceFilePathsFrom("", $this->dataFactory->getSourceFileName());
        $this->assertNotEmpty(
            $files,
            message: "Couldn't find any files related to {$factoryName}."
        );
    }

    public function testRetrievalFromCsvForAllRelatedFiles(): void
    {
        $relatedFilename = $this->dataFactory->getSourceFileName();
        $factoryName = $this->dataFactory::class;

        $baseResourcePath = $this->directoryManager->getResourceDirectoryPath("");

        $files = $this->fileManager->getResourceFilePathsFrom("", $this->dataFactory->getSourceFileName());
        $csvReader = new CsvReader($this->directoryManager, $this->fileManager);
        $fields = $this->dataFactory->getFields();

        foreach ($files as $file) {
            $path = $file->getPath();
            $fileRelativePath = Path::FOLDER_SEPARATOR . substr($path, strlen($baseResourcePath))
                . Path::FOLDER_SEPARATOR;

            $path = $fileRelativePath . $this->dataFactory->getBaseSourcePath();
            $this->checkResourcePath($path, $relatedFilename);

            $csvData = $csvReader->getCSVData($path, $relatedFilename, $fields);

            $this->assertCount(
                count($fields),
                array_keys($csvData[0]),
                message: "{$path}{$relatedFilename} has different number of fields than {$factoryName}"
            );

            $this->dataFactory->buildFromData($csvData, false);
        }
    }
}
