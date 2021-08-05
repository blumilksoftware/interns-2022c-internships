<?php

declare(strict_types=1);

namespace Internships\Testing\Backend;

use Internships\Factories\FacultyDataFactory;
use Internships\Models\Faculty;

class FacultyFactoryTest extends DataFactoryTestCase
{
    protected string $factoryClassName = FacultyDataFactory::class;
    protected string $expectedModelClassName = Faculty::class;
    protected bool $factoryCanReturnEmptyArray = false;
    protected bool $modelMustBeSerializable = true;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        static::$dataFactory = new FacultyDataFactory(static::$validator);
    }
}
