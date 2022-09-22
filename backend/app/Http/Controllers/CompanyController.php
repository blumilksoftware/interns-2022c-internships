<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Inertia\Response;
use Illuminate\Support\Str;
use Internships\Models\Company;
use Internships\Enums\Permission;
use Internships\Models\Department;
use Internships\Enums\CompanyStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Internships\Http\Requests\CompanyRequest;
use Internships\Http\Resources\CompanyResource;
use Illuminate\Auth\Access\AuthorizationException;
use Internships\Http\Resources\DepartmentResource;
use Internships\Http\Requests\Api\GetCompaniesRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Internships\Http\Requests\Api\GetManagedCompaniesRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyController extends Controller
{
    public function index(GetCompaniesRequest $request): Response
    {
        return $request->list();
    }

    public function manage(GetManagedCompaniesRequest $request): Response
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
    public function store(CompanyRequest $request): Response
    {
        return $this->show($request->data(), new GetCompaniesRequest())
            ->with(["success" => "status.company_created"]);
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Company $company, GetCompaniesRequest $request): Response
    {
        $this->authorize("show", $company);
        session(["view-source" => url()->previous()]);

        return $request->list()->with(
            "selectedCompany",
            new CompanyResource($company),
        );
    }

    public function close(): RedirectResponse
    {
        $source = session("view-source");

        if (Str::is(route("index"), $source)
            || Str::is(route("company-manage"), $source)
            || Str::is(route("index") . "/?*", $source)
            || Str::is(route("company-manage") . "/?*", $source)) {
            return Redirect::to($source)->withInput();
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

        return Redirect::route("company-manage");
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(Company $company): RedirectResponse
    {
        $this->authorize("destroy", $company);
        $company->delete();

        return Redirect::route("company-manage");
    }
}
