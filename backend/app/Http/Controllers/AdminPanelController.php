<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;
use Internships\Enums\CompanyStatus;
use Internships\Enums\Permission;
use Internships\Models\Company;

/**
 * @throws AuthorizationException
 */
class AdminPanelController extends Controller
{
    public function index(Request $request): Response
    {
        $this->authorize(Permission::ManageCompanies);
        $activeCompanies = Company::where("status", CompanyStatus::Verified)->get();
        $newCompanies = Company::where("status", CompanyStatus::PendingNew)->get();
        return inertia(
            "AdminPanel/Index",
            [
                "active" => $activeCompanies->count(),
                "created" => $newCompanies->count(),
            ],
        );
    }
}
