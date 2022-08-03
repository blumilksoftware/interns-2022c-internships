<?php

declare(strict_types=1);

namespace Internships\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * @param  \Illuminate\Http\Request  $request
     */
    protected function redirectTo($request) : string|null
    {
        if (!$request->expectsJson()) {
            return route("login");
        }

        return null;
    }
}
