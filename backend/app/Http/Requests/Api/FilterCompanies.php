<?php

declare(strict_types=1);

namespace Internships\Http\Requests\Api;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;

class FilterCompanies extends ApiRequest
{
    public function data($companiesQuery): Builder
    {
        return $companiesQuery->when(Request::input("searchbox"), function ($query, $search): void {
            $query->where("name", "like", "%" . $search . "%");
        })->when(Request::input("city"), function ($query, $citySelection): void {
            $query->whereJsonContains("address", ["city" => $citySelection]);
        })->when(Request::input("specialization"), function ($query, $specializationSelection): void {
            $query->whereHas("specializations", function ($query) use ($specializationSelection): void {
                $query->where("specialization_id", $specializationSelection);
            });
        });
    }
}