<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\Factories\CompanyDataFactory;
use Internships\Factories\DocumentConfigFactory;
use Internships\Factories\FacultyDataFactory;
use Internships\Models\DocumentConfig;
use Internships\Models\Faculty;
use Internships\Services\UniquePathGuard;

class ResourcesTest extends FromCsvTestCase
{
    /** @var Faculty[] */
    protected array $faculties;

    protected function setUp(): void
    {
        parent::setUp();

        $this->facultyFactory = new FacultyDataFactory($this->validator);
        $this->faculties = $this->retrieveWithFactory("", $this->facultyFactory);
    }

    public function testFacultyIntegrity(): void
    {
        $pathGuard = new UniquePathGuard();
        foreach ($this->faculties as $faculty) {
            $facultyDirectory = $faculty->getDirectory();
            $pathGuard->verifyIfUnique($facultyDirectory);

            $this->assertNotSame(
                "",
                $faculty->getName(),
                message: "Faculty {$faculty->getId()} has no name."
            );
            $this->assertNotSame(
                "",
                $facultyDirectory,
                message: "Faculty {$faculty->getId()} has no assigned directory."
            );

            $relativePath = $this->facultyFactory->getSourceRelativePath() . $facultyDirectory;
            $this->checkResourcePath(relativePath: $relativePath, fileName: "");
        }
    }

    public function testCompanyFileForEachFaculty(): void
    {
        $companyFactory = new CompanyDataFactory($this->fileManager, $this->validator);
        foreach ($this->faculties as $faculty) {
            $relativePath = $this->facultyFactory->getSourceRelativePath() . $faculty->getDirectory();

            $this->checkResourcePath(relativePath: $relativePath, fileName: "");
            $this->checkResourcePath(
                relativePath: $relativePath . $companyFactory->getBaseSourcePath(),
                fileName: $companyFactory->getSourceFileName()
            );
        }
    }

    public function testDocumentsForEachFaculty(): void
    {
        $documentFactory = new DocumentConfigFactory($this->validator);
        foreach ($this->faculties as $faculty) {
            $relativePath = $this->facultyFactory->getSourceRelativePath() . $faculty->getDirectory();

            $this->checkResourcePath(
                relativePath: $relativePath . $documentFactory->getBaseSourcePath(),
                fileName: $documentFactory->getSourceFileName()
            );

            /** @var DocumentConfig[] $documentConfigData */
            $documentConfigData = $this->retrieveWithFactory($relativePath, $documentFactory, true);

            foreach ($documentConfigData as $documentConfig) {
                $documentPath = $relativePath . $documentFactory->getBaseSourcePath();
                $this->checkResourcePath(
                    relativePath: $documentPath,
                    fileName: $documentConfig->getFilePath()
                );
            }
        }
    }
}
