<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\Factories\FacultyDataFactory;
use Internships\FileSystem\DirectoryManager;
use Internships\Services\DataValidator;
use PHPUnit\Framework\TestCase;

class GenericResourceTestCase extends TestCase
{
    protected DirectoryManager $directoryManager;
    protected FacultyDataFactory $facultyFactory;
    protected DataValidator $validator;

    protected function setUp(): void
    {
        $this->directoryManager = new DirectoryManager(
            rootDirectoryPath: __DIR__ . "/../../",
            relativeApiPath: "/dist/api/",
            relativeResourcePath: "/resources/"
        );
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
}
