<?php

declare(strict_types=1);

namespace Internships\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, class-string>
     */
    protected $policies = [
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
