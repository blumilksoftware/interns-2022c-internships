<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Response;
use Internships\Enums\CompanyStatus;
use Internships\Enums\Permission;
use Internships\Http\Requests\Api\GetCompaniesRequest;
use Internships\Http\Requests\CompanyRequest;
use Internships\Http\Resources\CompanyResource;
use Internships\Http\Resources\DepartmentResource;
use Internships\Models\Company;
use Internships\Models\Department;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CompanyController extends Controller
{
    public function index(GetCompaniesRequest $request): Response
    {
        return $request->list();
    }

    public function create(): Response
    {
        return inertia(
            "Company/Create",
            [
                "departments" => fn(): AnonymousResourceCollection
                => DepartmentResource::collection(Department::with("studyFields.specializations")->get()),
            ],
        );
    }

    /**
     * @throws UnknownProperties
     */
    public function store(CompanyRequest $request): RedirectResponse
    {
        Session::flash("success", "status.company_created");

        return Redirect::route("company-show", ["company" => $request->data()]);
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Company $company, GetCompaniesRequest $request): Response
    {
        $this->authorize("show", $company);

        return $request->list()->with(
            "selectedCompany",
            new CompanyResource($company),
        );
    }

    public function close(GetCompaniesRequest $request): RedirectResponse
    {
        $routeRegex = "/^" . str_replace("/", '\/', route("index")) . '(?:\?.*)?$/';

        if (url()->previous() && preg_match($routeRegex, url()->previous())) {
            return back()->withInput($request->query());
        }

        return Redirect::to(route("index"));
    }

    /**
     * @throws AuthorizationException
     */
    public function verify(Company $company): RedirectResponse
    {
        $this->authorize(Permission::ManageCompanies);

        $company->update([
            "status" => CompanyStatus::Verified,
        ]);

        return Redirect::route("index");
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(Company $company): RedirectResponse
    {
        $this->authorize("destroy", $company);
        $company->delete();

        return Redirect::route("index");
    }
}
