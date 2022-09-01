<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Inertia\Response;
use Internships\Enums\CompanyStatus;
use Internships\Http\Requests\CompanyRequest;
use Internships\Http\Resources\CityResource;
use Internships\Http\Resources\CompanyMarkerResource;
use Internships\Http\Resources\CompanyResource;
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
        $companiesQuery = Company::where("user_id", auth()->user()->id);
        $verifiedCompanies = $companiesQuery->get();

        $companiesFiltered = $companiesQuery->when(\Illuminate\Support\Facades\Request::input("searchbox"), function ($query, $search): void {
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
                "companies" => CompanyResource::collection($companiesFiltered->paginate(config("app.pagination", 15))
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
        $address = collect($request->address)->except(["coordinates"]);

        $fetchedLocation = (new LocationFetcher())
            ->query($address->implode(", "))
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
}
