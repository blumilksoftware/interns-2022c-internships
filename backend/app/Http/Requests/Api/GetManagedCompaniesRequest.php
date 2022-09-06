<?php

declare(strict_types=1);

namespace Internships\Http\Requests\Api;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Internships\Enums\CompanyStatus;
use Internships\Enums\Permission;
use Internships\Models\Company;

class GetManagedCompaniesRequest extends ApiRequest
{
    final public function authorize(): bool
    {
        return Auth::check();
    }

    public function data(): Builder
    {
        if (Gate::forUser(auth()->user())->allows(Permission::ManageCompanies->value)) {
            return Company::query()->orderBy("status", "asc")
                ->whereNot("status", CompanyStatus::PendingEdited);
        }

        return Company::where("user_id", auth()->user()->id)->orderBy("created_at", "desc");
    }
}
