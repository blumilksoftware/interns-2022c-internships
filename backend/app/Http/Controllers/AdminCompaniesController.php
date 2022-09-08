<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Inertia\Response;
use Internships\Enums\CompanyStatus;
use Internships\Enums\Permission;
use Internships\Http\Resources\CompanyResource;
use Internships\Models\Company;

/**
 * @throws AuthorizationException
 */
class AdminCompaniesController extends Controller
{
    public function companies(): Response
    {
        $this->authorize(Permission::ManageCompanies);
        $companiesQuery = Company::query();
        $companiesFiltered = $companiesQuery->when(Request::input("status"), function ($query, $statusSelect): void {
            $query->where("status", $statusSelect);
        });
        return inertia(
            "AdminPanel/CompaniesList",
            [
                "companies" => CompanyResource::collection($companiesFiltered->paginate(10)->withQueryString(), ),
                "filter" => Request::all("status"),
            ],
        );
    }

    public function show($company): Response
    {
        $this->authorize(Permission::ManageCompanies);
        return inertia(
            "AdminPanel/EditView",
            [
                "company" => CompanyResource::get($company),
            ],
        );
    }

    public function delete(Company $company)
    {
        $this->authorize(Permission::ManageCompanies);
        $company->delete();
        return redirect()->route("admin-companies")->with("message", "Company delete successfully");
    }

    public function update(Company $company): void
    {
        $this->authorize(Permission::ManageCompanies);
        $company->update(["status" => CompanyStatus::Verified]);
    }

    public function trashed(Request $request): Response
    {
        $this->authorize(Permission::ManageCompanies);
        $companies = Company::onlyTrashed();
        return inertia(
            "AdminPanel/TrashedListCompanies",
            [
                "companies" => CompanyResource::collection($companies->get()),
            ],
        );
    }

    public function restore($id)
    {
        $this->authorize(Permission::ManageCompanies);
        Company::where("id", $id)->onlyTrashed()->restore();
        return redirect()->route("admin-trashed-companies")->with("message", "Company restored successfully");
    }
}
