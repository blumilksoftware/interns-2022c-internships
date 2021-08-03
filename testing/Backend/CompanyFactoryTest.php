<?php

declare(strict_types=1);

namespace Internships\Testing\Backend;

use Internships\Factories\CompanyDataFactory;
use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;
use Internships\Models\Company;
use Internships\Services\DataSanitizer;
use Internships\Services\DataValidator;
use Internships\Services\UniquePathGuard;

class CompanyFactoryTest extends DataFactoryTestCase
{
    protected function setUp(): void
    {
        $this->fixtureFileName = "companies.csv";
        $this->factoryClassName = CompanyDataFactory::class;
        $this->expectedModelClassName = Company::class;
        $this->factoryCanReturnEmptyArray = true;

        $this->directoryManager = new DirectoryManager(
            rootDirectoryPath: __DIR__ . "/../",
            relativeApiPath: "/Fixtures/api/",
            relativeResourcePath: "/Fixtures/resources/"
        );
        $validator = new DataValidator(new DataSanitizer());
        $this->fileManager = new FileManager($this->directoryManager, new UniquePathGuard());

        $this->dataFactory = new CompanyDataFactory($this->fileManager, $validator);
    }
}
