<?php

declare(strict_types=1);

namespace Internships\Testing\Backend;

use Internships\Factories\CompanyDataFactory;
use Internships\Models\Company;

class CompanyFactoryTest extends DataFactoryTestCase
{
    protected string $factoryClassName = CompanyDataFactory::class;
    protected string $expectedModelClassName = Company::class;
    protected bool $factoryCanReturnEmptyArray = true;
    protected bool $modelMustBeSerializable = true;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        static::$dataFactory = new CompanyDataFactory(static::$fileManager, static::$validator);
    }
}
