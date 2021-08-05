<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\Factories\CompanyDataFactory;

class CompaniesIntegrityFactoryTest extends CsvFactoryTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->dataFactory = new CompanyDataFactory($this->fileManager, $this->validator);
    }
}
