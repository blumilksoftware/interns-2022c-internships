<?php

declare(strict_types=1);

namespace Internships\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Internships\Enums\Permission;
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
            "flash" => $this->getFlashData($request),
        ]);
    }

    public function getAuthData(Request $request): Closure
    {
        $user = $request->user();

        return fn(): array => [
            "user" => $user ? new UserResource($user) : null,
            "can" => [
                Permission::ManageCompanies->value => $user ? $user->can(Permission::ManageCompanies->value) : false,
                Permission::ManageUsers->value => $user ? $user->can(Permission::ManageUsers->value) : false,
            ],
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

    protected function getFlashData(Request $request): Closure
    {
        return fn(): array => [
            "success" => $request->session()->get("success"),
            "error" => $request->session()->get("error"),
            "info" => $request->session()->get("info"),
        ];
    }
}
