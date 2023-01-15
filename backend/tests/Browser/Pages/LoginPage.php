<?php

declare(strict_types=1);

namespace Tests\Browser\Pages;

class LoginPage extends Page
{
    public function url(): string
    {
        return "/login";
    }
}
