<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\Factories\CompanyDataFactory;

class CompaniesIntegrityTest extends FromCsvTestCase
{
    protected CompanyDataFactory $companyFactory;

    protected array $companies;
    protected function setUp(): void
    {
        parent::setUp();

        $this->companyFactory = new CompanyDataFactory($this->fileManager, $this->validator);
    }

    public function testCompanyNames(): void
    {
    }
}
