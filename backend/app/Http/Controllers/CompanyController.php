<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Internships\Models\Company;

class CompanyController extends Controller
{
    public function create(Request $request): Response
    {
        return inertia(
            "Company/Create",
        );
    }
}
