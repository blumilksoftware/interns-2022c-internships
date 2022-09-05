<?php

namespace Internships\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Internships\Enums\CompanyStatus;
use Internships\Enums\Role;
use Internships\Models\Company;
use Internships\Models\User;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function show(?User $user, Company $company): bool
    {
        if ($company->status === CompanyStatus::Verified || $company->user->is($user)) {
            return true;
        }

        return $user && in_array($user->role, [Role::Administrator, Role::Moderator], true);
    }

    public function destroy(User $user, Company $company): bool
    {
        if ($company->user->is($user)) {
            return true;
        }

        return in_array($user->role, [Role::Administrator, Role::Moderator], true);
    }
}
