<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;
use Internships\Enums\CompanyStatus;
use Internships\Models\Company;

class AdminPanelController extends Controller
{
    public function index(Request $request): Response
    {
        $activeCompanies = Company::where("status", CompanyStatus::Verified)->get();
        $newCompanies = Company::where("status", CompanyStatus::PendingNew)->get();
        $editedCompanies = Company::where("status", CompanyStatus::PendingEdited)->get();
        return inertia(
            "AdminPanel/Index",
            [
                "active" => $activeCompanies->count(),
                "created" => $newCompanies->count(),
                "edited" => $editedCompanies->count(),
            ],
        );
    }
}
