<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Response;
use Internships\Enums\CompanyStatus;
use Internships\Enums\Permission;
use Internships\Http\Requests\CompanyRequest;
use Internships\Http\Resources\CityResource;
use Internships\Http\Resources\CompanyMarkerResource;
use Internships\Http\Resources\CompanyResource;
use Internships\Http\Resources\CompanySummaryResource;
use Internships\Http\Resources\DepartmentResource;
use Internships\Models\Company;
use Internships\Models\Department;
use Internships\Models\Embeddable\Coordinates;
use Internships\Services\LocationFetcher;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CompanyController extends Controller
{
    public function index(): Response
    {
        if (Route::currentRouteName() === "company-index"):
            $companiesQuery = Company::where("user_id", auth()->user()->id);
        elseif (Route::currentRouteName() === "company-manage"):
            $this->authorize(Permission::ManageCompanies);
            $companiesQuery = Company::query()->orderBy("created_at", "desc")
                ->whereNot("status", CompanyStatus::PendingEdited);
        else:
            $companiesQuery = Company::query()->orderBy("has_signed_papers", "desc")
                ->where("status", CompanyStatus::Verified);
        endif;

        $verifiedCompanies = $companiesQuery->get();

        $companiesFiltered = $companiesQuery->when(Request::input("searchbox"), function ($query, $search): void {
            $query->where("name", "like", "%" . $search . "%");
        })->when(Request::input("city"), function ($query, $citySelection): void {
            $query->whereJsonContains("address", ["city" => $citySelection]);
        })->when(Request::input("specialization"), function ($query, $specializationSelection): void {
            $query->whereHas("specializations", function ($query) use ($specializationSelection): void {
                $query->where("specialization_id", $specializationSelection);
            });
        });

        return inertia(
            "CompanyBrowser/Index",
            [
                "markers" => CompanyMarkerResource::collection($companiesFiltered->get()),
                "cities" => CityResource::collection($verifiedCompanies),
                "companies" => CompanySummaryResource::collection($companiesFiltered->paginate(config("app.pagination", 15))
                    ->withQueryString(), ),
                "departments" => DepartmentResource::collection(Department::all()),
                "filters" => Request::all(["searchbox", "city", "specialization"]),
            ],
        );
    }

    public function create(Request $request): Response
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
        $fetchedLocation = (new LocationFetcher())
            ->query(collect($request->address)->except(["coordinates"])->implode(", "))
            ->getLocations()
            ->first();

        $coordinates = new Coordinates([
            "latitude" => $fetchedLocation["coordinates"][1],
            "longitude" => $fetchedLocation["coordinates"][0],
        ]);

        $company = Company::query()->create($request->data($coordinates));

        return redirect()
            ->route("company-index")
            ->with("success", __("Company :name request created", [
                "name" => $company->name,
            ]));
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Company $company): Response
    {
        $this->authorize("show", $company);

        return $this->index()->with(
            "selectedCompany", new CompanyResource($company),
        );
    }

    /**
     * @throws AuthorizationException
     */
    public function setStatus($id): RedirectResponse
    {
        $this->authorize(Permission::ManageCompanies);

        Company::query()->where("id", $id)->update([
                'status' => CompanyStatus::Verified,
        ]);

        return redirect()->route("company-manage")->with('success', 'status.company_status_set');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Company $company): RedirectResponse
    {
        $this->authorize("destroy", $company);

        Company::query()->where("id", $company->id)->delete();

        return redirect()->route("company-manage")->with('success', 'status.company_deleted');
    }
}
