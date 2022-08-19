<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Internships\Services\LocationFetcher;

class GetLocationController extends Controller
{
    public function __invoke(Request $request, LocationFetcher $locationFetcher): Collection
    {
        return $locationFetcher->query($request->address)
            ->getLocations();
    }
}
