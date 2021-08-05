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

abstract class CsvFactoryTestCase extends GenericResourceTestCase
{
    protected static ?FileManager $fileManager;
    protected static ?DataValidator $validator;
    protected static ?CsvReader $csvReader;
    protected static ?DataFactory $dataFactory;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        static::$fileManager = new FileManager(static::$directoryManager, new UniquePathGuard());
        static::$validator = new DataValidator(new DataSanitizer());
        static::$csvReader = new CsvReader(static::$directoryManager, static::$fileManager);
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        static::$fileManager = null;
        static::$validator = null;
        static::$csvReader = null;
        static::$dataFactory = null;
    }

    public function testIfRelatedFilesExist(): void
    {
        $factoryName = static::$dataFactory::class;
        $files = static::$fileManager->getResourceFilePathsFrom("", static::$dataFactory->getSourceFileName());
        $this->assertNotEmpty(
            $files,
            message: "Couldn't find any files related to {$factoryName}."
        );
    }

    public function testRetrievalForAllRelatedFiles(): void
    {
        $files = static::$fileManager->getResourceFilePathsFrom("", static::$dataFactory->getSourceFileName());
        $baseResourcePath = static::$directoryManager->getResourceDirectoryPath("");
        foreach ($files as $file) {
            $fileRelativePath = Path::FOLDER_SEPARATOR . substr($file->getPath(), strlen($baseResourcePath))
                . Path::FOLDER_SEPARATOR;
            $this->retrieveWithFactory($fileRelativePath, $file->getFilename());
        }
    }

    protected function retrieveWithFactory(string $resourcePath, string $filename): array
    {
        $factoryName = static::$dataFactory::class;

        $this->checkResourcePath($resourcePath, $filename);
        $fields = static::$dataFactory->getFields();
        $csvData = static::$csvReader->getCSVData($resourcePath, $filename, $fields);

        $this->assertCount(
            count($fields),
            array_keys($csvData[0]),
            message: "{$resourcePath}{$filename} has different number of fields than {$factoryName}"
        );

        return static::$dataFactory->buildFromData($csvData, false);
    }
}
