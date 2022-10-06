<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    public function testTheApplicationReturnsASuccessfulResponse(): void
    {
        $response = $this->get("/");

        $response->assertStatus(200);
    }
}
