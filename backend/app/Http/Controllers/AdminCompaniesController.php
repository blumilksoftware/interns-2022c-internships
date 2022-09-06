<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Inertia\Response;
use Internships\Models\Company;
use Internships\Http\Resources\CompanyResource;
use Internships\Http\Resources\UserResource;
use Internships\Enums\CompanyStatus;

class AdminCompaniesController extends Controller
{
    public function companies(): Response
    {
        $companiesQuery = Company::query();
        $companiesFiltered = $companiesQuery->when(Request::input("status"), function($query, $statusSelect): void{
            $query->where("status", $statusSelect);
        });
        return inertia(
            "AdminPanel/CompaniesList",
            [
                "companies" => CompanyResource::collection($companiesFiltered->paginate(10)->withQueryString(),),
                "filter" => Request::all("status"),
            ],
        );
    }
    public function delete(Company $company)
    {
        $company->delete();
        return redirect()->route('admin-companies')->with('message', 'Company delete successfully');

    }
    public function update(Company $company)
    {
        $company->update(["status"=>CompanyStatus::Verified]);
    }
    public function restore(Company $company)
    {
        $company->restore();
        return redirect()->route('admin-trashed')->with('message', 'Company restored successfully');

    }
}
