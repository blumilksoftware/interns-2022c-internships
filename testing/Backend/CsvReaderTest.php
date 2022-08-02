<?php

declare(strict_types=1);

namespace Internships\Testing\Backend;

use Internships\Exceptions\File\CsvInvalidCountFileException;
use Internships\Exceptions\File\NoFieldRowCsvException;
use Internships\Exceptions\Path\NotFoundPathException;
use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;
use Internships\FileSystem\RelativePathIdentity;
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
            relativeResourcePath: "/Fixtures/resources/",
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
        $relativePathIdentity = new RelativePathIdentity(
            sourceName: "sourceFile.csv",
            destinationName: "sourceFile.csv",
        );
        $this->expectException(NoFieldRowCsvException::class);
        static::$csvReader->getCsvData($relativePathIdentity, []);
    }

    public function testThrowInvalidFieldCount(): void
    {
        $relativePathIdentity = new RelativePathIdentity(
            relativeChangingPath: "/faculties/",
            sourceName: "faculties.csv",
            destinationName: "faculties.csv",
        );
        $this->expectException(CsvInvalidCountFileException::class);
        static::$csvReader->getCsvData($relativePathIdentity, []);
    }

    public function testThrowFileNotFound(): void
    {
        $relativePathIdentity = new RelativePathIdentity(
            sourceName: "invalid.not.present",
            destinationName: "invalid.not.present",
        );

        $this->expectException(NotFoundPathException::class);
        static::$csvReader->getCsvData($relativePathIdentity, []);
    }

    public function testCsvFileReading(): void
    {
        $relativePathIdentity = new RelativePathIdentity(
            relativeChangingPath: "/faculties/",
            sourceName: "faculties.csv",
            destinationName: "faculties.csv",
        );
        $data = static::$csvReader->getCsvData($relativePathIdentity, ["name", "directory"]);
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
        $initialFilePathIdentity = new RelativePathIdentity(
            sourceName: "initial.csv",
            destinationName: "initial.csv",
        );
        $savePathIdentity = new RelativePathIdentity(
            sourceName: "save.csv",
            destinationName: "save.csv",
        );

        $dataOnFirstRead = static::$csvReader->getCsvData($initialFilePathIdentity, ["", ""]);
        static::$csvReader->saveData($savePathIdentity, $dataOnFirstRead);
        $dataAfterSave = static::$csvReader->getCsvData($savePathIdentity, ["", ""]);
        $this->assertSame($dataOnFirstRead, $dataAfterSave, "Saving csv without changes should result in the same array.");
    }

    public function testSaveAltersDataWithChanges(): void
    {
        $initialFilePathIdentity = new RelativePathIdentity(
            sourceName: "initial.csv",
            destinationName: "initial.csv",
        );
        $savePathIdentity = new RelativePathIdentity(
            sourceName: "save.csv",
            destinationName: "save.csv",
        );

        $newValueInFile = "SavedField";
        $dataOnFirstRead = static::$csvReader->getCsvData($initialFilePathIdentity, ["", ""]);
        $dataOnFirstReadAltered = $dataOnFirstRead;
        $dataOnFirstReadAltered[0][0] = $newValueInFile;
        static::$csvReader->saveData($savePathIdentity, $dataOnFirstReadAltered);
        $dataAfterSave = static::$csvReader->getCsvData($savePathIdentity, ["", ""]);
        $this->assertNotSame($dataOnFirstRead, $dataAfterSave, "CsvReader hasn't modified any data.");
        $this->assertNotSame($newValueInFile, $dataAfterSave[0], "CsvReader hasn't modified data in expected way.");
    }
}
