<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;
use Internships\Models\Company;

class AdminCompaniesController extends Controller
{
    public function companies(Request $request): Response
    {
        $companies = Company::paginate(10);
        return inertia(
            "AdminPanel/CompaniesList",
            [
                "companies" => $companies,
            ],
        );
    }
}
