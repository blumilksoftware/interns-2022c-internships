<?php

declare(strict_types=1);

namespace Internships\Http\Requests\Api;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Inertia\Response;
use Internships\Enums\CompanyStatus;
use Internships\Enums\Permission;
use Internships\Http\Resources\CityResource;
use Internships\Http\Resources\CompanySummaryResource;
use Internships\Http\Resources\DepartmentResource;
use Internships\Models\Company;
use Internships\Models\Department;

class GetCompaniesRequest extends ApiRequest
{
    public function list(
        string $expectedPath,
        FilterCompanies $filter = new FilterCompanies()
    ): Response {
        $companies = $this->data();

        return inertia(
            "Company/Index",
            [
                "cities" => fn(): AnonymousResourceCollection
                => CityResource::collection($companies->pluck("address")),
                "departments" => fn(): AnonymousResourceCollection
                => DepartmentResource::collection(Department::with("studyFields.specializations")->get()),
                "filters" => fn(): array
                => Request::only(["searchbox", "city", "specialization"]),
                "markers" => fn(): AnonymousResourceCollection
                => CompanySummaryResource::collection($filter->data($companies)->get()),
                "companies" => fn(): AnonymousResourceCollection
                => CompanySummaryResource::collection(
                    $filter->data($companies)->paginate(config("app.pagination", 15))
                        ->setPath($expectedPath)
                ),
            ],
        );
    }

    protected function data(): Builder
    {
        if (Gate::forUser(auth()->user())->allows(Permission::ManageCompanies->value)) {
            return Company::query()->orderBy("status", "asc")
                ->whereNot("status", CompanyStatus::PendingEdited);
        }

        return Company::query()->orderBy("has_signed_papers", "desc")
            ->where("status", CompanyStatus::Verified)
            ->when(auth()->user(), function (Builder $query): void {
                $query->orWhere("user_id", auth()->user()->id);
            });
    }
}
