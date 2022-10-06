<?php

declare(strict_types=1);

namespace Internships\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind("path.public", fn() => base_path() . "/public");
    }

    public function boot(): void
    {
    }
}
