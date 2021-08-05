<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\Factories\DataFactory;
use Internships\Factories\FacultyDataFactory;
use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;
use Internships\Services\CsvReader;
use Internships\Services\DataSanitizer;
use Internships\Services\DataValidator;
use Internships\Services\UniquePathGuard;
use PHPUnit\Framework\TestCase;

class FromCsvTestCase extends TestCase
{
    protected FileManager $fileManager;
    protected CsvReader $csvReader;
    protected DirectoryManager $directoryManager;
    protected FacultyDataFactory $facultyFactory;
    protected DataValidator $validator;

    protected function setUp(): void
    {
        $this->directoryManager = new DirectoryManager(
            rootDirectoryPath: __DIR__ . "/../../",
            relativeApiPath: "/dist/api/",
            relativeResourcePath: "/resources/"
        );
        $this->fileManager = new FileManager($this->directoryManager, new UniquePathGuard());
        $this->validator = new DataValidator(new DataSanitizer());
    }

    protected function checkResourcePath(string $relativePath, string $fileName, bool $checkWrite = false): void
    {
        $path = $this->directoryManager->getResourceFilePath($relativePath, $fileName);
        if ($fileName === "") {
            $this->assertDirectoryExists($path);
        } else {
            $this->assertFileExists($path);
            if ($checkWrite) {
                $this->assertFileIsWritable($path);
            }
        }
    }

    protected function retrieveWithFactory(
        string $relativeDirectory,
        DataFactory $dataFactory,
        bool $allowEmptyResult = false
    ): array {
        $factoryName = $dataFactory::class;

        $path = $relativeDirectory . $dataFactory->getBaseSourcePath();
        $filename = $dataFactory->getSourceFileName();
        $this->checkResourcePath($path, $filename);

        $fields = $dataFactory->getFields();
        $csvReader = new CsvReader($this->directoryManager, $this->fileManager);
        $csvData = $csvReader->getCSVData($path, $filename, $dataFactory->getFields());

        $this->assertCount(
            count($fields),
            array_keys($csvData[0]),
            message: "{$path}{$filename} has different number of fields than {$factoryName}"
        );

        if (!$allowEmptyResult) {
            $this->assertNotCount(
                expectedCount: 1,
                haystack: $csvData,
                message: "${factoryName} expects at least one non-field row from {$path}{$filename}."
            );
        }

        $data = $dataFactory->buildFromData($csvData);

        return $data;
    }
}
