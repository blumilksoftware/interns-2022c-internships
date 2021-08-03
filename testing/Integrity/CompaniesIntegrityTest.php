<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\Factories\CompanyDataFactory;
use Internships\FileSystem\Path;
use Internships\Models\Company;

class CompaniesIntegrityTest extends FromCsvTestCase
{
    protected CompanyDataFactory $companyFactory;

    /** @var Company[][] */
    protected array $companiesFromFiles;

    protected function setUp(): void
    {
        parent::setUp();
        $this->companiesFromFiles = [];
        $this->companyFactory = new CompanyDataFactory($this->fileManager, $this->validator);

        $files = $this->fileManager->getResourceFilePathsFrom("", $this->companyFactory->getSourceFileName());
        $this->assertNotEmpty(
            $files,
            message: "Couldn't find any files related to companies."
        );
        $baseResourcePath = $this->directoryManager->getResourceDirectoryPath("");

        foreach ($files as $file) {
            $path = $file->getPath();
            $fileRelativePath = Path::FOLDER_SEPARATOR . substr($path, strlen($baseResourcePath))
                . Path::FOLDER_SEPARATOR;

            $companyData = $this->retrieveWithFactory(
                "{$fileRelativePath}",
                $this->companyFactory,
                allowEmptyResult: true
            );
            $this->companiesFromFiles[$file->getPathname()] = $companyData;
        }
    }

    public function testCompanyNames(): void
    {
        foreach ($this->companiesFromFiles as $companies) {
            foreach ($companies as $rowNumber => $company) {
                $csvOffset = $rowNumber+1;
                $semiSanitizedText = preg_replace('/\s+/', "", $company->getName());
                $fileKey = key($companies);

                $this->assertNotSame(
                    "",
                    $semiSanitizedText,
                    message: "Validation for Company Name at {$csvOffset} in {$fileKey} failed."
                    . " Name should contain non-whitespace characters."
                );
            }
        }
    }
}
