<?php

declare(strict_types=1);

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    public function testThatTrueIsTrue(): void
    {
        $this->assertTrue(true);
    }
}
