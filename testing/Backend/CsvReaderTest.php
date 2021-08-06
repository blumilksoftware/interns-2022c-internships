<?php

namespace Internships\Testing\Backend;

use Internships\Exceptions\File\CsvInvalidCountFileException;
use Internships\Exceptions\File\NoFieldRowCsvException;
use Internships\Exceptions\Path\NotFoundPathException;
use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;
use Internships\Services\CsvReader;
use Internships\Services\DataSanitizer;
use Internships\Services\DataValidator;
use Internships\Services\UniquePathGuard;
use PHPUnit\Framework\TestCase;

class CsvReaderTest extends TestCase
{
    protected static ?DirectoryManager $directoryManager;
    protected static ?FileManager $fileManager;
    protected static ?DataValidator $validator;
    protected static ?CsvReader $csvReader;

    public static function setUpBeforeClass(): void
    {
        static::$directoryManager = new DirectoryManager(
            rootDirectoryPath: __DIR__ . "/../",
            relativeApiPath: "/Fixtures/api/",
            relativeResourcePath: "/Fixtures/resources/"
        );
        static::$validator = new DataValidator(new DataSanitizer());
        static::$fileManager = new FileManager(static::$directoryManager, new UniquePathGuard());
        static::$csvReader = new CsvReader(static::$directoryManager, static::$fileManager);
    }

    public static function tearDownAfterClass(): void
    {
        static::$directoryManager = null;
        static::$validator = null;
        static::$fileManager = null;
        static::$csvReader = null;
    }

    public function testThrowNoFieldException()
    {
        $this->expectException(NoFieldRowCsvException::class);
        static::$csvReader->getCSVData("", "empty.csv", []);
    }

    public function testThrowInvalidFieldCount()
    {
        $this->expectException(CsvInvalidCountFileException::class);
        static::$csvReader->getCSVData("", "faculties.csv", []);
    }

    public function testThrowFileNotFound()
    {
        $this->expectException(NotFoundPathException::class);
        static::$csvReader->getCSVData("", "invalid.not.present", []);
    }

    public function testCsvFileReading()
    {
        $data = static::$csvReader->getCSVData("", "faculties.csv", ["name", "directory"]);
        $this->assertCount(3, $data, "Fixture file faculties.csv should have specified number of rows.");

        $expectedRows = [
            ["Faculty name", "Directory"],
            ["Faculty of Technical and Economic Sciences", "faculty-technical"],
            ["Faculty of Social and Human Sciences", "faculty-social"],
        ];
        $this->assertEquals($expectedRows, $data);
    }

    public function testSaveNotAltersDataWithoutChanges()
    {
        $dataOnFirstRead = static::$csvReader->getCSVData("", "initial.csv", ["", ""]);
        static::$csvReader->saveData("", "save.csv", $dataOnFirstRead);
        $dataAfterSave = static::$csvReader->getCSVData("", "save.csv", ["", ""]);
        $this->assertEquals($dataOnFirstRead, $dataAfterSave, "Saving csv without changes should result in the same array.");
    }

    public function testSaveAltersDataWithChanges()
    {
        $newValueInFile = "Saved Field";
        $dataOnFirstRead = static::$csvReader->getCSVData("", "initial.csv", ["", ""]);
        $dataOnFirstReadAltered = $dataOnFirstRead;
        $dataOnFirstReadAltered[0][0] = $newValueInFile;
        static::$csvReader->saveData("", "save.csv", $dataOnFirstReadAltered);
        $dataAfterSave = static::$csvReader->getCSVData("", "save.csv", ["", ""]);
        $this->assertNotEquals($dataOnFirstRead, $dataAfterSave, "CsvReader hasn't modified data.");
        $this->assertNotEquals($newValueInFile, $dataAfterSave[0], "CsvReader hasn't modified data in expected way.");
    }
}