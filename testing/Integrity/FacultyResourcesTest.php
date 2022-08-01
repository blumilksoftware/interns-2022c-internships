<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\Factories\CompanyDataFactory;
use Internships\Factories\DataFactory;
use Internships\Factories\DocumentConfigFactory;
use Internships\Factories\FacultyDataFactory;
use Internships\Models\Faculty;

class FacultyResourcesTest extends CsvFactoryTestCase
{
    /** @var array<Faculty> */
    protected static ?array $faculties;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$dataFactory = new FacultyDataFactory(static::$validator);
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        self::$dataFactory = null;
        static::$faculties = null;
    }

    protected function setUp(): void
    {
        if (isset($faculties)) {
            return;
        }

        static::$faculties = $this->retrieveWithFactory(static::$dataFactory->getRelativePathIdentity());
    }

    public function testFacultyDataDirectory(): void
    {
        $fullIdentity = static::$directoryManager->getFullPathIdentity(static::$dataFactory->getRelativePathIdentity());
        $mainFacultyPath = $fullIdentity->getFullSourcePath();
        foreach (static::$faculties as $faculty) {
            $facultyDirectory = $faculty->getDirectory();
            $path = $mainFacultyPath . $facultyDirectory;
            $this->assertDirectoryExists($path);
        }
    }

    public function testIfFileExistsPerFacultyForEachSubFactory(): void
    {
        $subFactories = [
            new CompanyDataFactory(static::$fileManager, static::$validator),
            new DocumentConfigFactory(static::$fileManager, static::$validator),
        ];

        $facultyRelativePathIdentity = static::$dataFactory->getRelativePathIdentity();
        /** @var DataFactory $subFactory */
        foreach ($subFactories as $subFactory) {
            foreach (static::$faculties as $faculty) {
                $relativeSubIdentity = $subFactory->getRelativePathIdentity();
                $relativeSubIdentity->setParentIdentity($facultyRelativePathIdentity);
                $relativeSubIdentity->setChangingPath($faculty->getDirectory());

                $this->checkResourcePath($relativeSubIdentity);
            }
        }
    }
}
