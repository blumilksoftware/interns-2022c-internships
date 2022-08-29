<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;

class CompanyController extends Controller
{
    public function create(Request $request): Response
    {
        return inertia(
            "Company/Create",
        );
    }
}
