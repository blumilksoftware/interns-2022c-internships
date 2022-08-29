<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;
use Internships\Enums\CompanyStatus;
use Internships\Http\Resources\DepartmentResource;
use Internships\Models\Company;
use Internships\Models\Department;

class CompanyBrowserController extends Controller
{
    public function index(Request $request): Response
    {
        $companies = Company::where("status", CompanyStatus::Verified)->paginate(15);
        $cities = [
            [
                "id" => 0,
                "label" => "Legnica",
            ],
            [
                "id" => 1,
                "label" => "Bogatynia",
            ],
        ];

        return inertia(
            "CompanyBrowser/Index",
            [
                "companies" => $companies,
                "departments" => DepartmentResource::collection(Department::all()),
                "cities" => $cities,
            ],
        );
    }
}
