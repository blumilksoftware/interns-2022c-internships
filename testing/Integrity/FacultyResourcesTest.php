<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\Factories\CompanyDataFactory;
use Internships\Factories\DocumentConfigFactory;
use Internships\Factories\FacultyDataFactory;
use Internships\Models\Faculty;

class FacultyResourcesTest extends CsvFactoryTestCase
{
    /** @var Faculty[] */
    protected static ?array $faculties;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        static::$dataFactory = new FacultyDataFactory(static::$validator);
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        static::$faculties = null;
    }

    protected function setUp(): void
    {
        if (isset($faculties)) {
            return;
        }

        static::$faculties = $this->retrieveWithFactory(
            static::$dataFactory->getBaseSourcePath(),
            static::$dataFactory->getSourceFileName()
        );
    }

    public function testFacultyDataDirectory(): void
    {
        foreach (static::$faculties as $faculty) {
            $facultyDirectory = $faculty->getDirectory();
            $relativePath = static::$dataFactory->getSourceRelativePath() . $facultyDirectory;
            $this->checkResourcePath(relativePath: $relativePath, fileName: "");
        }
    }

    public function testIfFileExistsPerFacultyForEachSubFactory(): void
    {
        $subFactories = [
            new CompanyDataFactory(static::$fileManager, static::$validator),
            new DocumentConfigFactory(static::$validator),
        ];

        foreach ($subFactories as $subFactory) {
            foreach (static::$faculties as $faculty) {
                $relativePath = static::$dataFactory->getSourceRelativePath() . $faculty->getDirectory();

                $this->checkResourcePath(
                    relativePath: $relativePath . $subFactory->getBaseSourcePath(),
                    fileName: $subFactory->getSourceFileName()
                );
            }
        }
    }
}
