<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\FileSystem\DirectoryManager;
use PHPUnit\Framework\TestCase;

abstract class GenericResourceTestCase extends TestCase
{
    protected static ?DirectoryManager $directoryManager;

    public static function setUpBeforeClass(): void
    {
        static::$directoryManager = new DirectoryManager(
            rootDirectoryPath: __DIR__ . "/../../",
            relativeApiPath: "/dist/api/",
            relativeResourcePath: "/resources/"
        );
    }

    public static function tearDownAfterClass(): void
    {
        static::$directoryManager = null;
    }

    protected function checkResourcePath(string $relativePath, string $fileName, bool $checkWrite = false): void
    {
        $path = static::$directoryManager->getResourceFilePath($relativePath, $fileName);
        if ($fileName === "") {
            $this->assertDirectoryExists($path);
        } else {
            $this->assertFileExists($path);
            if ($checkWrite) {
                $this->assertFileIsWritable($path);
            }
        }
    }
}
