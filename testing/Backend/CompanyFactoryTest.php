<?php

declare(strict_types=1);

namespace Internships\Testing\Backend;

use Internships\Factories\CompanyDataFactory;
use Internships\Models\Company;

class CompanyFactoryTest extends DataFactoryTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$dataFactory = new CompanyDataFactory(static::$fileManager, static::$validator);
    }

    protected function setUp(): void
    {
        $this->factoryClassName = CompanyDataFactory::class;
        $this->expectedModelClassName = Company::class;
        $this->factoryCanReturnEmptyArray = true;
        $this->modelMustBeSerializable = true;
    }
}
