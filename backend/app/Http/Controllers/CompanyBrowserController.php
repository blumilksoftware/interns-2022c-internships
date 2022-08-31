<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\Request;
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
    public function index(Request $request): Response
    {
        $companies = Company::where("status", CompanyStatus::Verified)->orderBy("has_signed_papers", "desc");

        return inertia(
            "CompanyBrowser/Index",
            [
                "markers" => CompanyMarkerResource::collection($companies->get()),
                "cities" => CityResource::collection($companies->get()),
                "companies" => CompanyResource::collection($companies->paginate(config("app.pagination", 15))),
                "departments" => DepartmentResource::collection(Department::all()),
            ],
        );
    }
}
