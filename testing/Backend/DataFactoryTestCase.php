<?php

declare(strict_types=1);

namespace Internships\Testing\Backend;

use Internships\Factories\DataFactory;
use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;
use Internships\Services\CsvReader;
use Internships\Services\DataSanitizer;
use Internships\Services\DataValidator;
use Internships\Services\UniquePathGuard;
use JsonSerializable;
use PHPUnit\Framework\TestCase;

abstract class DataFactoryTestCase extends TestCase
{
    protected static ?DirectoryManager $directoryManager;
    protected static ?FileManager $fileManager;
    protected static ?DataValidator $validator;
    protected static ?DataFactory $dataFactory;

    protected string $factoryClassName;
    protected string $expectedModelClassName;
    protected bool $factoryCanReturnEmptyArray;
    protected bool $modelMustBeSerializable;

    public static function setUpBeforeClass(): void
    {
        static::$directoryManager = new DirectoryManager(
            rootDirectoryPath: __DIR__ . "/../",
            relativeApiPath: "/Fixtures/api/",
            relativeResourcePath: "/Fixtures/resources/"
        );
        static::$validator = new DataValidator(new DataSanitizer());
        static::$fileManager = new FileManager(static::$directoryManager, new UniquePathGuard());
    }

    public static function tearDownAfterClass(): void
    {
        static::$directoryManager = null;
        static::$validator = null;
        static::$fileManager = null;
        static::$dataFactory = null;
    }

    public function testIfClassIsDataFactory(): void
    {
        $this->assertTrue(
            is_subclass_of($this->factoryClassName, DataFactory::class),
            message: "Class {$this->factoryClassName} is not a data factory."
        );
    }

    public function testIfFactoryDefinesFields(): void
    {
        $fields = static::$dataFactory->getFields();
        $this->assertNotEmpty(
            $fields,
            message: "{$this->factoryClassName} should define at least one field."
        );

        $this->assertNotTrue(
            key_exists("id", $fields),
            message: "{$this->factoryClassName}: id shouldn't be defined within factory fields."
        );
    }

    public function testIfModelIsJsonSerializable(): void
    {
        if (!$this->modelMustBeSerializable) {
            $this->expectNotToPerformAssertions();
            return;
        }
        $modelName = $this->expectedModelClassName;
        $implementations = class_implements($modelName);
        $this->assertTrue(
            isset($implementations[JsonSerializable::class]),
            message: "Model {$modelName} is not JsonSerializable."
        );
    }

    public function testIfModelHasRequiredFunctions(): void
    {
        $modelName = $this->expectedModelClassName;
        $methods = [
            "getId",
        ];
        foreach ($methods as $method) {
            $this->assertTrue(
                method_exists($modelName, $method),
                message: "Model {$modelName} has no required {$method} method."
            );
        }
    }

    public function testFixtureFileIntegrity(): void
    {
        $sourceFileName = static::$dataFactory->getSourceFileName();
        $pathToFixture = static::$directoryManager->getResourceFilePath("", $sourceFileName);
        $this->assertFileExists(
            $pathToFixture,
            message: "Cannot build data from a non-existent file."
        );

        $csvReader = new CsvReader(static::$directoryManager, static::$fileManager);
        $csvFields = $csvReader->getFieldRow("", $sourceFileName, static::$dataFactory->getFields());

        $this->assertCount(
            count(static::$dataFactory->getFields()),
            array_keys($csvFields),
            message: "{$sourceFileName} has different number of fields from {$this->factoryClassName}"
        );
    }

    public function testIfFactoryBuildsCorrectly(): void
    {
        $factoryName = $this->factoryClassName;

        $csvReader = new CsvReader(static::$directoryManager, static::$fileManager);
        $csvData = $csvReader->getCsvData(
            resourceRelativePath: "",
            fileName: static::$dataFactory->getSourceFileName(),
            fieldDefines: static::$dataFactory->getFields()
        );

        $data = static::$dataFactory->buildFromData($csvData, false);

        $this->assertIsArray(
            $data,
            message: "{$factoryName} should return an array on build."
        );

        if (!$this->factoryCanReturnEmptyArray) {
            $this->assertNotEmpty(
                $data,
                message: "{$factoryName} shouldn't return an empty array for built data."
            );
        }

        $expectedId = 0;
        $modelName = static::$dataFactory->getModelClassToBuild();
        foreach ($data as $modelObject) {
            $this->assertInstanceOf(
                $modelName,
                $modelObject,
                message: "{$factoryName} failed to create {$modelName} on build."
            );

            $this->assertSame(
                $expectedId++,
                $modelObject->getId(),
                message: "{$factoryName} failed assignment of identifiers on build."
            );
        }
    }
}
