<?php

namespace Internships\Http\Requests\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Internships\Enums\CompanyStatus;
use Internships\Enums\Permission;
use Internships\Models\Company;

class GetManagedCompaniesRequest extends ApiRequest
{
    public final function authorize(): bool
    {
        return Auth::check();
    }

    public function data(){
        if(Gate::forUser(auth()->user())->allows(Permission::ManageCompanies->value)){
            return Company::query()->orderBy("created_at", "desc")
                ->whereNot("status", CompanyStatus::PendingEdited);
        }
        else {
            return Company::where("user_id", auth()->user()->id);
        }
    }
}
