<?php

declare(strict_types=1);

namespace Internships\Http\Requests\Api;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;

class FilterCompanies extends ApiRequest
{
    public function data(Builder $companiesQuery): Builder
    {
        $search = Request::input("searchbox");
        return $companiesQuery->when(filled($search), function (Builder $query) use ($search): void {
            $query->where("name", "like", "%" . $search . "%");
        })->when(Request::input("city"), function (Builder $query, string $citySelection): void {
            $query->whereJsonContains("address", ["city" => $citySelection]);
        })->when(Request::input("specialization"), function (Builder $query, string $specializationSelection): void {
            $query->whereHas("specializations", function (Builder $query) use ($specializationSelection): void {
                $query->where("specialization_id", $specializationSelection);
            });
        })->when(Request::input("owned"), function (Builder $query, string $ownedSelect): void {
            if (auth()->user() && $ownedSelect === "owned") {
                $query->where("user_id", auth()->user()->id);
            }
        })->when(Request::input("companyStatus"), function (Builder $query, string $companyStatus): void {
            $query->where("status", $companyStatus);
        });
    }
}
