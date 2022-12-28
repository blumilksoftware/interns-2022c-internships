<?php

declare(strict_types=1);

namespace Tests\Browser\Pages;

class RegisterPage extends Page
{
    public function url(): string
    {
        return "/register";
    }

    public function elements(): array
    {
        return [
            "@element" => "#selector",
        ];
    }
}
