<?php

declare(strict_types=1);

namespace Internships\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /** @var array<int, class-string|string> */
    protected $middleware = [
        // \Internships\Http\Middleware\TrustHosts::class,
        \Internships\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \Internships\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Internships\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /** @var array<string, array<int, class-string|string>> */
    protected $middlewareGroups = [
        "web" => [
            \Internships\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Internships\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        "api" => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            "throttle:api",
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /** @var array<string, class-string|string> */
    protected $routeMiddleware = [
        "auth" => \Internships\Http\Middleware\Authenticate::class,
        "auth.basic" => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        "auth.session" => \Illuminate\Session\Middleware\AuthenticateSession::class,
        "cache.headers" => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        "can" => \Illuminate\Auth\Middleware\Authorize::class,
        "guest" => \Internships\Http\Middleware\RedirectIfAuthenticated::class,
        "password.confirm" => \Illuminate\Auth\Middleware\RequirePassword::class,
        "signed" => \Illuminate\Routing\Middleware\ValidateSignature::class,
        "throttle" => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        "verified" => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
