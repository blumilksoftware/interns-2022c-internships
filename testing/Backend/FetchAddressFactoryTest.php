<?php

declare(strict_types=1);

namespace Internships\Testing\Backend;

use Internships\Factories\FetchAddressDataFactory;
use Internships\Models\FetchAddress;

class FetchAddressFactoryTest extends DataFactoryTestCase
{
    protected string $factoryClassName = FetchAddressDataFactory::class;
    protected string $expectedModelClassName = FetchAddress::class;
    protected bool $factoryCanReturnEmptyArray = true;
    protected bool $modelMustBeSerializable = false;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        static::$dataFactory = new FetchAddressDataFactory(static::$validator);
    }
}
