<?php

declare(strict_types=1);

namespace Internships\Testing\Backend;

use Internships\Factories\FetchAddressDataFactory;
use Internships\Models\FetchAddress;

class FetchAddressFactoryTest extends DataFactoryTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        FetchAddressFactoryTest::$dataFactory = new FetchAddressDataFactory(static::$validator);
    }

    protected function setUp(): void
    {
        $this->factoryClassName = FetchAddressDataFactory::class;
        $this->expectedModelClassName = FetchAddress::class;
        $this->factoryCanReturnEmptyArray = true;
        $this->modelMustBeSerializable = false;
    }
}
