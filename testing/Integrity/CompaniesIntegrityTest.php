<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\Factories\CompanyDataFactory;
use Internships\FileSystem\Path;
use Internships\Models\Company;

class CompaniesIntegrityTest extends FromCsvTestCase
{
    protected CompanyDataFactory $companyFactory;

    /** @var Company[][] $companies  */
    protected array $companiesFromFiles;
    protected function setUp(): void
    {
        parent::setUp();

        $this->companyFactory = new CompanyDataFactory($this->fileManager, $this->validator);
        $files = $this->fileManager->getResourceFilePathsFrom("", $this->companyFactory->getSourceFileName());
        $baseResourcePath = $this->directoryManager->getResourceDirectoryPath("");
        foreach($files as $file){
            $path = $file->getPath();

            $fileRelativePath = Path::FOLDER_SEPARATOR . substr($path, strlen($baseResourcePath))
                . Path::FOLDER_SEPARATOR;
           $companyData = $this->retrieveWithFactory("{$fileRelativePath}", $this->companyFactory, true);
           var_dump($companyData);
        }
    }

    public function testCompanyNames(): void
    {
    }
}
