<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Response;
use Internships\Http\Requests\Api\FilterCompanies;
use Internships\Http\Requests\Api\GetCompaniesRequest;
use Internships\Http\Requests\Api\GetManagedCompaniesRequest;
use Internships\Http\Requests\CompanyRequest;
use Internships\Http\Resources\CityResource;
use Internships\Http\Resources\CompanyResource;
use Internships\Http\Resources\CompanySummaryResource;
use Internships\Http\Resources\DepartmentResource;
use Internships\Models\Company;
use Internships\Models\Department;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CompanyController extends Controller
{
    protected function list(GetCompaniesRequest|GetManagedCompaniesRequest $request,
                            FilterCompanies $filter = new FilterCompanies()): Response|array{
        $companies = $request->data();

        return inertia(
            "CompanyBrowser/Index",
            [
                "cities" => fn () => CityResource::collection($companies->pluck("address")),
                "departments" => fn () => DepartmentResource::collection(Department::with("studyFields.specializations")->get()),
                "filters" => fn () => Request::only(["searchbox", "city", "specialization"]),
                "markers" => fn () => CompanySummaryResource::collection($filter->data($companies)->get()),
                "companies" => fn () => CompanySummaryResource::collection($filter->data($companies)->paginate(config("app.pagination", 15))
                    ->withQueryString(), ),
            ],
        );
    }

    public function index(GetCompaniesRequest $request): Response|array
    {
        return $this->list($request);
    }

    public function manage(): Response
    {
        return $this->list(new GetManagedCompaniesRequest());
    }

    public function create(): Response
    {
        return inertia(
            "Company/Create",
        );
    }

    /**
     * @throws UnknownProperties
     */
    public function store(CompanyRequest $request): RedirectResponse
    {
        return redirect()->route("company-manage")
            ->with("success", __("Company :name request created", [
                "name" => $request->data()->name,
            ]));
    }

    public function show(int $id, GetCompaniesRequest $request): Response
    {
        session(['view-source' => url()->previous()]);
        return $this->list($request)->with(
            "selectedCompany",
            new CompanyResource(Company::find($id)),
        );
    }

    public function close(): RedirectResponse
    {
        $source = session('view-source');

        if($source === route("company-manage")){
            return Redirect::to($source);
        }
        else {
            return Redirect::to(route("index"));
        }
    }

    public function update(Company $id)
    {
        Company::query()->where("id", $id)->first()->update(
            Request::validate([
                'status' => ['verified'],
            ])
        );

        return redirect()->route("company-manage")
            ->with('success', 'companies updated.');
    }

    public function destroy($id)
    {
        Company::find($id)->delete();

        return redirect()->route("company-manage")
            ->with('success', 'company deleted.');
    }
}
