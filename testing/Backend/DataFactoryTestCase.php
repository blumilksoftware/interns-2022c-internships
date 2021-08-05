<?php

declare(strict_types=1);

namespace Internships\Testing\Backend;

use Internships\Factories\DataFactory;
use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;
use Internships\Services\CsvReader;
use JsonSerializable;
use PHPUnit\Framework\TestCase;

class DataFactoryTestCase extends TestCase
{
    protected string $factoryClassName;
    protected string $expectedModelClassName;
    protected DirectoryManager $directoryManager;
    protected FileManager $fileManager;
    protected DataFactory $dataFactory;
    protected string $fixtureFileName;
    protected bool $factoryCanReturnEmptyArray;
    protected bool $modelMustBeSerializable = true;

    public function testIfClassIsDataFactory(): void
    {
        $this->assertTrue(
            is_subclass_of($this->factoryClassName, DataFactory::class),
            message: "Class {$this->factoryClassName} is not a data factory."
        );
    }

    public function testIfFactoryDefinesFields(): void
    {
        $fields = $this->dataFactory->getFields();
        $this->assertNotEmpty(
            $fields,
            message: "{$this->factoryClassName} should define at least one field."
        );

        $this->assertNotTrue(
            key_exists("id", $fields),
            message: "{$this->factoryClassName}: id shouldn't be defined within factory fields."
        );
    }

    public function testFixtureFileIntegrity(): void
    {
        $sourceFileName = $this->fixtureFileName;

        $pathToFixture = $this->directoryManager->getResourceFilePath("", $sourceFileName);
        $this->assertFileExists(
            $pathToFixture,
            message: "Cannot build data from a non-existent file."
        );

        $csvReader = new CsvReader($this->directoryManager, $this->fileManager);
        $csvData = $csvReader->getCSVData("", $sourceFileName, $this->dataFactory->getFields());

        $this->assertCount(
            count($this->dataFactory->getFields()),
            array_keys($csvData[0]),
            message: "{$sourceFileName} has different number of fields from {$this->factoryClassName}"
        );
    }

    public function testIfModelIsJsonSerializable(): void
    {
        if (!$this->modelMustBeSerializable) {
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

    public function testIfFactoryBuildsCorrectly(): void
    {
        $factory = $this->dataFactory;
        $factoryName = $this->factoryClassName;
        $sourceFileName = $this->fixtureFileName;
        $allowEmpty = $this->factoryCanReturnEmptyArray;

        $csvReader = new CsvReader($this->directoryManager, $this->fileManager);
        $csvData = $csvReader->getCSVData("", $sourceFileName, $this->dataFactory->getFields());

        $data = $factory->buildFromData($csvData, false);
        $this->assertIsArray(
            $data,
            message: "{$factoryName} should return an array on build."
        );

        if (!$allowEmpty) {
            $this->assertNotEmpty(
                $data,
                message: "{$factoryName} shouldn't return an empty array for built data."
            );
        }

        $expectedId = 0;
        foreach ($data as $modelObject) {
            $this->assertInstanceOf(
                $this->dataFactory->getModelClassToBuild(),
                $modelObject,
                message: "{$factoryName} failed to create model on build."
            );

            $this->assertSame(
                $expectedId++,
                $modelObject->getId(),
                message: "{$factoryName} failed assignment of identifiers."
            );
        }
    }
}
