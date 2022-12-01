<?php

declare(strict_types=1);

namespace Tests\Browser\Pages;

class CompanyCreatePage extends Page
{
    public function url(): string
    {
        return "/company/create";
    }

    public function elements(): array
    {
        return [
            "@element" => "#selector",
        ];
    }
}
