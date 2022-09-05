<?php

declare(strict_types=1);

namespace Internships\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Internships\Enums\Permission;
use Internships\Enums\Role;
use Internships\Models\Company;
use Internships\Models\User;
use Internships\Policies\CompanyPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Company::class => CompanyPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::before(function (User $user) {
            if ($user->role === Role::Administrator) {
                return true;
            }
        });

        Gate::define(Permission::ManageCompanies->value, fn(User $user): bool => $user->role === Role::Moderator);
        Gate::define(Permission::ManageUsers->value, fn(User $user): bool => $user->role === Role::Administrator);
    }
}
