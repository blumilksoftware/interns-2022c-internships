<?php

declare(strict_types=1);

namespace Internships\Testing\Backend;

use Internships\Factories\FacultyDataFactory;
use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;
use Internships\Models\Faculty;
use Internships\Services\DataSanitizer;
use Internships\Services\DataValidator;
use Internships\Services\UniquePathGuard;

class FacultyFactoryTest extends DataFactoryTestCase
{
    protected function setUp(): void
    {
        $this->fixtureFileName = "faculties.csv";
        $this->factoryClassName = FacultyDataFactory::class;
        $this->expectedModelClassName = Faculty::class;
        $this->factoryCanReturnEmptyArray = false;

        $this->directoryManager = new DirectoryManager(
            rootDirectoryPath: __DIR__ . "/../",
            relativeApiPath: "/Fixtures/api/",
            relativeResourcePath: "/Fixtures/resources/"
        );
        $validator = new DataValidator(new DataSanitizer());
        $this->fileManager = new FileManager($this->directoryManager, new UniquePathGuard());
        $this->dataFactory = new FacultyDataFactory($validator);
    }
}
