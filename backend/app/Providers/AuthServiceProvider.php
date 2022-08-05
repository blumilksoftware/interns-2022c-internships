<?php

declare(strict_types=1);

namespace Internships\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
