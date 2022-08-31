<?php

declare(strict_types=1);

namespace Internships\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Internships\Http\Resources\UserResource;
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
            "auth" => $this->getAuthData($request),
            "ziggy" => $this->getZiggyData($request),
        ]);
    }

    public function getAuthData(Request $request): Closure
    {
        $user = $request->user();

        return fn(): array => [
            "user" => $user ? new UserResource($user) : null,
        ];
    }

    public function getZiggyData(Request $request): Closure
    {
        return function () use ($request): array {
            return array_merge((new Ziggy())->toArray(), [
                "location" => $request->url(),
            ]);
        };
    }
}
