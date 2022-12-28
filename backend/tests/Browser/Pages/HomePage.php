<?php

declare(strict_types=1);

namespace Tests\Browser\Pages;

class HomePage extends Page
{
    public function url(): string
    {
        return "/";
    }

    public function elements(): array
    {
        return [
            "@element" => "#selector",
        ];
    }
}
