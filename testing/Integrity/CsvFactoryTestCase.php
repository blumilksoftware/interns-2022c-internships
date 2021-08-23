<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\Factories\DataFactory;
use Internships\FileSystem\FileManager;
use Internships\FileSystem\RelativePathIdentity;
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
        static::$fileManager = new FileManager(GenericResourceTestCase::$directoryManager, new UniquePathGuard());
        static::$validator = new DataValidator(new DataSanitizer());
        static::$csvReader = new CsvReader(GenericResourceTestCase::$directoryManager, self::$fileManager);
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        static::$fileManager = null;
        static::$validator = null;
        static::$csvReader = null;
    }

    public function testIfRelatedFilesExist(): void
    {
        $factoryName = static::$dataFactory::class;
        $files = static::$fileManager->getResourceFilePathsFrom(
            relativeOrigin: "",
            specificFileName: static::$dataFactory->getRelativePathIdentity()->getSourceName()
        );
        $this->assertNotEmpty(
            $files,
            message: "Couldn't find any files related to {$factoryName}."
        );
    }

    public function testRetrievalForAllRelatedFiles(): void
    {
        $files = static::$fileManager->getResourceFilePathsFrom(
            relativeOrigin: "",
            specificFileName: static::$dataFactory->getRelativePathIdentity()->getSourceName()
        );
        foreach ($files as $file) {
            $this->retrieveWithFactory($file);
        }
    }

    protected function retrieveWithFactory(RelativePathIdentity $pathIdentity): array
    {
        $factoryName = static::$dataFactory::class;

        $this->checkResourcePath($pathIdentity);
        $fields = static::$dataFactory->getFields();
        $csvData = static::$csvReader->getCsvData($pathIdentity, $fields);

        $fullIdentity = static::$directoryManager->getFullPathIdentity($pathIdentity);
        $this->assertCount(
            count($fields),
            array_keys($csvData[0]),
            message: "{$fullIdentity->getFullSourceFilePath()} has different number of fields than {$factoryName}"
        );

        return static::$dataFactory->buildFromData($csvData, false);
    }
}
