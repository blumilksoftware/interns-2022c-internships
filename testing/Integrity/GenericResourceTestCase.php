<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\RelativePathIdentity;
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

    protected function checkResourcePath(RelativePathIdentity $relativePathIdentity, bool $checkWrite = false): void
    {
        $fullIdentity = static::$directoryManager->getFullPathIdentity($relativePathIdentity);
        if ($fullIdentity->getSourceName() === "") {
            $this->assertDirectoryExists($fullIdentity->getFullSourcePath());
        } else {
            $this->assertFileExists($fullIdentity->getFullSourceFilePath());
            if ($checkWrite) {
                $this->assertFileIsWritable($fullIdentity->getFullSourceFilePath());
            }
        }
    }
}
