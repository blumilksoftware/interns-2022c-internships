<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\Factories\CompanyDataFactory;

class CompaniesResourceTest extends CsvFactoryTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        CompaniesResourceTest::$dataFactory = new CompanyDataFactory(static::$fileManager, static::$validator);
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        CompaniesResourceTest::$dataFactory = null;
    }
}
