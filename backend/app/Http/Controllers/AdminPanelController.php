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
        $ActiveCompanies = Company::where("status", CompanyStatus::Verified)->get();
        $NewCompanies = Company::where("status", CompanyStatus::PendingNew)->get();
        $EditedCompanies = Company::where("status", CompanyStatus::PendingEdited)->get();
        return inertia(
            "AdminPanel/Index",
            [
                "active" => $ActiveCompanies->count(),
                "created" => $NewCompanies->count(),
                "edited" => $EditedCompanies->count(),
            ],
        );
    }
}
