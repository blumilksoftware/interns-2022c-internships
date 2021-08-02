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
    protected bool $initialized = false;
    protected CsvReader $csvReader;
    protected DirectoryManager $directoryManager;
    protected FileManager $fileManager;
    protected FacultyDataFactory $facultyFactory;
    protected DataValidator $validator;
    /** @var Faculty[] $faculties */
    protected array $faculties;

    protected function setUp(): void
    {
        if($this->initialized){
            return;
        }
        $this->directoryManager = new DirectoryManager(
            rootDirectoryPath: __DIR__ . "/../../",
            relativeApiPath: "/public/api/",
            relativeResourcePath: "/resources/"
        );
        $this->fileManager = new FileManager($this->directoryManager, new UniquePathGuard());
        $this->validator = new DataValidator(new DataSanitizer());
        $this->facultyFactory = new FacultyDataFactory($this->validator);

        $this->faculties = $this->retrieveWithFactory("", $this->facultyFactory);
        $this->initialized = true;
    }

    public function testFacultyIntegrity(): void{
        $pathGuard = new UniquePathGuard();
        foreach ($this->faculties as $faculty) {
            $facultyDirectory = $faculty->getDirectory();
            $pathGuard->verifyIfUnique($facultyDirectory);

            $this->assertNotSame("", $faculty->getName());
            $this->assertNotSame("", $facultyDirectory);

            $relativePath = $this->facultyFactory->getSourceRelativePath() . $facultyDirectory;
            $this->checkResourcePath(relativePath: $relativePath, fileName: "");
        }
    }

    public function testCompanyFileForEachFaculty():void
    {
        $companyFactory = new CompanyDataFactory($this->fileManager, $this->validator);
        foreach ($this->faculties as $faculty) {
            $relativePath = $this->facultyFactory->getSourceRelativePath() . $faculty->getDirectory();

            $this->checkResourcePath(relativePath: $relativePath, fileName: "");
            $this->checkResourcePath(
                relativePath: $relativePath . $companyFactory->getBaseSourcePath(),
                fileName: $companyFactory->getSourceFileName()
            );
        }
    }

    public function testDocumentsForEachFaculty(): void
    {
        $documentFactory = new DocumentConfigFactory($this->validator);
        foreach ($this->faculties as $faculty) {
            $relativePath = $this->facultyFactory->getSourceRelativePath() . $faculty->getDirectory();

            $this->checkResourcePath(
                relativePath: $relativePath . $documentFactory->getBaseSourcePath(),
                fileName: $documentFactory->getSourceFileName()
            );

            /** @var DocumentConfig[] $documentConfigData */
            $documentConfigData = $this->retrieveWithFactory($relativePath, $documentFactory, true);

            foreach ($documentConfigData as $documentConfig) {
                $documentPath = $relativePath . $documentFactory->getBaseSourcePath();
                $this->checkResourcePath(
                    relativePath: $documentPath,
                    fileName: $documentConfig->getFilePath()
                );
            }
        }
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
    ): array
    {
        $factoryName = $dataFactory::class;
        $this->assertTrue(
            is_subclass_of($dataFactory, DataFactory::class),
            message: "Class {$factoryName} is not a data factory."
        );

        $path = $relativeDirectory . $dataFactory->getSourceRelativePath();
        $filename = $dataFactory->getSourceFileName();
        $this->checkResourcePath($path, $filename);

        $fields = $dataFactory->getFields();
        $csvReader = new CsvReader($this->directoryManager, $this->fileManager);
        $csvData = $csvReader->getCSVData($path, $filename, $fields);

        $this->assertIsArray($csvData[0], message: "Failed creation of array from CSV file.");
        $this->assertCount(count($fields), array_keys($csvData[0]),
            message: "{$path}{$filename} has different number of fields than {$factoryName}");

        $data = $dataFactory->buildFromData($csvData);
        $this->assertIsArray($data);
        if (!$allowEmptyResult) {
            $this->assertNotEmpty($data,
            message: "$factoryName shouldn't return empty array for built data.");
        }
        $expectedId = 0;
        foreach ($data as $modelObject) {
            $this->assertInstanceOf($dataFactory->getModelClassToBuild(), $modelObject);
            $this->assertTrue(
                method_exists($modelObject::class, 'getId'),
                message: "Model generated by {$factoryName} has no required getId method."
            );
            $this->assertSame(
                $expectedId++,
                $modelObject->getId(),
                message: "Factory failed assignment of identifiers"
            );
        }

        return $data;
    }
}
