<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\Factories\CompanyDataFactory;

class CompaniesResourceTest extends CsvFactoryTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        static::$dataFactory = new CompanyDataFactory(static::$fileManager, static::$validator);
    }
}
