<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Inertia\Response;
use Internships\Enums\CompanyStatus;
use Internships\Http\Resources\CityResource;
use Internships\Http\Resources\CompanyMarkerResource;
use Internships\Http\Resources\CompanyResource;
use Internships\Http\Resources\DepartmentResource;
use Internships\Models\Company;
use Internships\Models\Department;

class CompanyBrowserController extends Controller
{
    public function index(): Response
    {
        $companiesQuery = Company::query()->orderBy("has_signed_papers", "desc")
            ->where("status", CompanyStatus::Verified);
        $verifiedCompanies = $companiesQuery->get();

        $companiesFiltered = $companiesQuery->when(Request::input("searchbox"), function ($query, $search): void {
            $query->where("name", "like", "%" . $search . "%");
        })->when(Request::input("city"), function ($query, $citySelection): void {
            $query->whereJsonContains("address", ["city" => $citySelection]);
        })->when(Request::input("specialization"), function ($query, $specializationSelection): void {
            $query->whereHas("specializations", function ($query) use ($specializationSelection): void {
                $query->where("specialization_id", $specializationSelection);
            });
        });

        return inertia(
            "CompanyBrowser/Index",
            [
                "markers" => CompanyMarkerResource::collection($companiesFiltered->get()),
                "cities" => CityResource::collection($verifiedCompanies),
                "companies" => CompanyResource::collection($companiesFiltered->paginate(config("app.pagination", 15))
                    ->withQueryString(), ),
                "departments" => DepartmentResource::collection(Department::all()),
                "filters" => Request::all(["searchbox", "city", "specialization"]),
            ],
        );
    }
}
