<?php

declare(strict_types=1);

use Internships\Factories\CompanyDataFactory;
use Internships\Factories\DataFactory;
use Internships\Factories\FacultyDataFactory;
use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;
use Internships\Models\Faculty;
use Internships\Services\CsvReader;
use Internships\Services\DataSanitizer;
use Internships\Services\DataValidator;
use Internships\Services\UniquePathGuard;
use PHPUnit\Framework\TestCase;

class ResourcesTest extends TestCase
{
    protected CsvReader $csvReader;
    protected DirectoryManager $directoryManager;
    protected FileManager $fileManager;

    protected FacultyDataFactory $facultyFactory;
    protected CompanyDataFactory $companyFactory;

    protected function setUp(): void
    {
        $this->directoryManager = new DirectoryManager(
            rootDirectoryPath: __DIR__ . "/../../",
            relativeApiPath: "/public/api/",
            relativeResourcePath: "/resources/"
        );
        $this->fileManager = new FileManager($this->directoryManager, new UniquePathGuard());
        $this->csvReader = new CsvReader($this->directoryManager, $this->fileManager);

        $this->facultyFactory = new FacultyDataFactory(new DataValidator(new DataSanitizer()));
    }

    public function testFaculties(): void
    {
        /** @var Faculty[] $data */
        $faculties = $this->retrieveWithFactory("", $this->facultyFactory);

        $expectedId = 0;
        /** @var Faculty $faculty */
        foreach ($faculties as $faculty) {
            $this->assertSame($expectedId++, $faculty->getId());
            $this->assertNotSame("", $faculty->getName());
            $this->assertNotSame("", $faculty->getDirectory());
            $relativePath = $this->facultyFactory->getSourceRelativePath() . $faculty->getDirectory();
            $this->getAndCheckResourcePath(relativePath: $relativePath, fileName: "");
        }
    }

    protected function getAndCheckResourcePath(string $relativePath, string $fileName): string
    {
        $path = $this->directoryManager->getResourceFilePath($relativePath, $fileName);
        if ($fileName === "") {
            $this->assertDirectoryExists($path);
        } else {
            $this->assertFileExists($path);
        }
        return $path;
    }

    protected function retrieveWithFactory(
        string $relativeDirectory,
        DataFactory $dataFactory,
        bool $allowEmptyResult = false
    ): array {
        $this->assertTrue(is_subclass_of($dataFactory, DataFactory::class));

        $path = $relativeDirectory . $dataFactory->getSourceRelativePath();
        $filename = $dataFactory->getSourceFileName();
        $fullPath = $this->directoryManager->getResourceFilePath($path, $filename);
        $this->assertFileExists($fullPath);

        $fields = $dataFactory->getFields();
        $csvData = $this->csvReader->getCSVData($path, $filename, $fields);
        $this->assertIsArray($csvData[0]);
        $this->assertCount(count($fields), array_keys($csvData[0]));

        $data = $dataFactory->buildFromData($csvData);
        $this->assertIsArray($data);
        if (!$allowEmptyResult) {
            $this->assertNotEmpty($data);
        }
        foreach ($data as $modelObject) {
            $this->assertInstanceOf($dataFactory->getModelClassToBuild(), $modelObject);
        }

        return $data;
    }
}
