<?php

declare(strict_types=1);

use Internships\Factories\CompanyDataFactory;
use Internships\Factories\DataFactory;
use Internships\Factories\DocumentConfigFactory;
use Internships\Factories\FacultyDataFactory;
use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;
use Internships\Models\DocumentConfig;
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
    protected DocumentConfigFactory $documentFactory;

    protected function setUp(): void
    {
        $this->directoryManager = new DirectoryManager(
            rootDirectoryPath: __DIR__ . "/../../",
            relativeApiPath: "/public/api/",
            relativeResourcePath: "/resources/"
        );
        $this->fileManager = new FileManager($this->directoryManager, new UniquePathGuard());
        $this->csvReader = new CsvReader($this->directoryManager, $this->fileManager);

        $validator = new DataValidator(new DataSanitizer());
        $this->facultyFactory = new FacultyDataFactory($validator);
        $this->companyFactory = new CompanyDataFactory($this->fileManager, $validator);
        $this->documentFactory = new DocumentConfigFactory($validator);
    }

    public function testResourceDirectoryContent(): void
    {
        /** @var Faculty[] $faculties */
        $faculties = $this->retrieveWithFactory("", $this->facultyFactory);

        $expectedId = 0;
        foreach ($faculties as $faculty) {
            $this->assertSame($expectedId++, $faculty->getId());
            $this->assertNotSame("", $faculty->getName());
            $this->assertNotSame("", $faculty->getDirectory());

            $relativePath = $this->facultyFactory->getSourceRelativePath() . $faculty->getDirectory();
            $this->getAndCheckResourcePath(relativePath: $relativePath, fileName: "");
            $this->getAndCheckResourcePath(
                relativePath: $relativePath . $this->companyFactory->getBaseSourcePath(),
                fileName: $this->companyFactory->getSourceFileName()
            );

            $this->getAndCheckResourcePath(
                relativePath: $relativePath . $this->documentFactory->getBaseSourcePath(),
                fileName: $this->documentFactory->getSourceFileName()
            );

            /** @var DocumentConfig[] $documentConfigData */
            $documentConfigData = $this->retrieveWithFactory($relativePath, $this->documentFactory, true);

            foreach ($documentConfigData as $documentConfig) {
                $documentPath = $relativePath . $this->documentFactory->getBaseSourcePath();
                $this->getAndCheckResourcePath(
                    relativePath: $documentPath,
                    fileName: $documentConfig->getFilePath()
                );
            }
        }
    }

    protected function getAndCheckResourcePath(string $relativePath, string $fileName, bool $checkWrite = false): string
    {
        $path = $this->directoryManager->getResourceFilePath($relativePath, $fileName);
        if ($fileName === "") {
            $this->assertDirectoryExists($path);
        } else {
            $this->assertFileExists($path);
            if($checkWrite){
                $this->assertFileIsWritable($path);
            }
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
        $this->getAndCheckResourcePath($path, $filename);

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
