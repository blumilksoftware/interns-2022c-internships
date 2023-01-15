<?php

declare(strict_types=1);

namespace Tests\Browser\Pages;

class VerifyEmailPage extends Page
{
    public function url(): string
    {
        return "/verify-email";
    }
}
