<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;
use Internships\Enums\CompanyStatus;
use Internships\Models\Company;

class CompanyBrowserController extends Controller
{
    public function index(Request $request): Response
    {
        $companies = Company::where("status", CompanyStatus::Verified)->paginate(15);

        return inertia("CompanyBrowser/Index", ["companies" => $companies]);
    }
}
