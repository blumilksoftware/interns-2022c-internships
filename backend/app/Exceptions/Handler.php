<?php

declare(strict_types=1);

namespace Internships\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $levels = [
    ];
    protected $dontReport = [
    ];
    protected $dontFlash = [
        "current_password",
        "password",
        "password_confirmation",
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e): void {
        });
    }
}
