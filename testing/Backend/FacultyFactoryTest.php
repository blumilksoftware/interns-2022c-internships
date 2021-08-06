<?php

declare(strict_types=1);

namespace Internships\Testing\Backend;

use Internships\Factories\FacultyDataFactory;
use Internships\Models\Faculty;

class FacultyFactoryTest extends DataFactoryTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        FacultyFactoryTest::$dataFactory = new FacultyDataFactory(static::$validator);
    }

    protected function setUp(): void
    {
        $this->factoryClassName = FacultyDataFactory::class;
        $this->expectedModelClassName = Faculty::class;
        $this->factoryCanReturnEmptyArray = false;
        $this->modelMustBeSerializable = true;
    }
}
