<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Inertia\Response;
use Internships\Enums\CompanyStatus;
use Internships\Enums\Permission;
use Internships\Http\Requests\CompanyRequest;
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

    public function show(Company $company)
    {
        $this->authorize(Permission::ManageCompanies);
        return inertia(
            "AdminPanel/EditPage",
            [
                "company" => [
                    "id" => $company->id,
                    "name" => $company->name,
                    "address" => $company->address,
                    "description" => $company->description,
                    "contact_details" => $company->contact_details,
                ],
            ],
        );
    }

    public function store(CompanyRequest $request, Company $company): RedirectResponse
    {
        $this->authorize(Permission::ManageCompanies);
        $request->validate([
            "name" => "required",
            "address" => "required",
            "description" => "required",
            "contact_details" => "required",
        ]);

        $company->update($request->all());

        return redirect()->route("admin-companies")
            ->with("success", "status.company_updated");
    }

    public function delete(Company $company)
    {
        $this->authorize(Permission::ManageCompanies);
        $company->delete();
        return redirect()->route("admin-companies")->with("success", "status.company_deleted");
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
        return redirect()->route("admin-trashed-companies")->with("success", "status.company_restored");
    }
}
