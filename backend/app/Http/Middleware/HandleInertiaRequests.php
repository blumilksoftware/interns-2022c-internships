<?php

declare(strict_types=1);

namespace Internships\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = "app";

    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            "auth" => [
                "user" => $request->user(),
            ],
            "" => function () use ($request) {
                return array_merge((new Ziggy())->toArray(), [
                    "location" => $request->url(),
                ]);
            },
        ]);
    }
}
