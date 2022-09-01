<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Internships\Http\Requests\CompanyRequest;
use Internships\Http\Resources\CityResource;
use Internships\Http\Resources\CompanyMarkerResource;
use Internships\Http\Resources\DepartmentResource;
use Internships\Models\Company;
use Internships\Models\Department;
use Internships\Models\Embeddable\Coordinates;
use Internships\Services\LocationFetcher;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CompanyController extends Controller
{
    public function index(Request $request): Response
    {
        $companies = Company::where("user_id", auth()->user()->id);

        return inertia(
            "CompanyBrowser/Index",
            [
                "markers" => CompanyMarkerResource::collection($companies->get()),
                "cities" => CityResource::collection($companies->get()),
                "companies" => $companies->paginate(config("app.pagination", 15)),
                "departments" => DepartmentResource::collection(Department::all()),
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
            ->query($address->toJson())
            ->getLocations()
            ->first();

        $coordinates = new Coordinates([
            "latitude" => $fetchedLocation["coordinates"][0],
            "longitude" => $fetchedLocation["coordinates"][1],
        ]);

        $company = Company::query()->create($request->data($coordinates));

        return redirect()
            ->route("company-index")
            ->with("success", __(":name", [
                "name" => $company->name,
            ]));
    }
}
