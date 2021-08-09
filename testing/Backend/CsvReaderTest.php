<?php

declare(strict_types=1);

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

    public function testThrowNoFieldException(): void
    {
        $this->expectException(NoFieldRowCsvException::class);
        static::$csvReader->getCsvData("", "empty.csv", []);
    }

    public function testThrowInvalidFieldCount(): void
    {
        $this->expectException(CsvInvalidCountFileException::class);
        static::$csvReader->getCsvData("", "faculties.csv", []);
    }

    public function testThrowFileNotFound(): void
    {
        $this->expectException(NotFoundPathException::class);
        static::$csvReader->getCsvData("", "invalid.not.present", []);
    }

    public function testCsvFileReading(): void
    {
        $data = static::$csvReader->getCsvData("", "faculties.csv", ["name", "directory"]);
        $this->assertCount(3, $data, "Fixture file faculties.csv should have specified number of rows.");

        $expectedRows = [
            ["Faculty name", "Directory"],
            ["Faculty of Technical and Economic Sciences", "faculty-technical"],
            ["Faculty of Social and Human Sciences", "faculty-social"],
        ];
        $this->assertSame($expectedRows, $data);
    }

    public function testSaveNotAltersDataWithoutChanges(): void
    {
        $dataOnFirstRead = static::$csvReader->getCsvData("", "initial.csv", ["", ""]);
        static::$csvReader->saveData("", "save.csv", $dataOnFirstRead);
        $dataAfterSave = static::$csvReader->getCsvData("", "save.csv", ["", ""]);
        $this->assertSame($dataOnFirstRead, $dataAfterSave, "Saving csv without changes should result in the same array.");
    }

    public function testSaveAltersDataWithChanges(): void
    {
        $newValueInFile = "SavedField";
        $dataOnFirstRead = static::$csvReader->getCsvData("", "initial.csv", ["", ""]);
        $dataOnFirstReadAltered = $dataOnFirstRead;
        $dataOnFirstReadAltered[0][0] = $newValueInFile;
        static::$csvReader->saveData("", "save.csv", $dataOnFirstReadAltered);
        $dataAfterSave = static::$csvReader->getCsvData("", "save.csv", ["", ""]);
        $this->assertNotSame($dataOnFirstRead, $dataAfterSave, "CsvReader hasn't modified any data.");
        $this->assertNotSame($newValueInFile, $dataAfterSave[0], "CsvReader hasn't modified data in expected way.");
    }
}
