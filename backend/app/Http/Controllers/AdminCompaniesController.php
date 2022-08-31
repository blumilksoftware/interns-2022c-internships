<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;

class AdminCompaniesController extends Controller
{
    public function companies(Request $request): Response
    {
        return inertia(
            "AdminPanel/Companies",
        );
    }
}
