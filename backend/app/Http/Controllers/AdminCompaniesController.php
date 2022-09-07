<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Inertia\Response;
use Internships\Enums\CompanyStatus;
use Internships\Http\Resources\CompanyResource;
use Internships\Models\Company;

class AdminCompaniesController extends Controller
{
    public function companies(): Response
    {
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
        return inertia(
            "AdminPanel/EditView",
            [
                'company' => CompanyResource::get($company)
            ]
            );
    }

    public function delete(Company $company)
    {
        $company->delete();
        return redirect()->route("admin-companies")->with("message", "Company delete successfully");
    }

    public function update(Company $company): void
    {
        $company->update(["status" => CompanyStatus::Verified]);
    }

    public function trashed(Request $request): Response
    {
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
        Company::where("id", $id)->onlyTrashed()->restore();
        return redirect()->route("admin-trashed-companies")->with("message", "Company restored successfully");
    }
}
