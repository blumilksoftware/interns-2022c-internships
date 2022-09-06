<?php

declare(strict_types=1);

namespace Internships\Http\Requests\Api;

use Illuminate\Database\Eloquent\Builder;
use Internships\Enums\CompanyStatus;
use Internships\Models\Company;

class GetCompaniesRequest extends ApiRequest
{
    public function data(): Builder
    {
        return Company::query()->orderBy("has_signed_papers", "desc")
            ->where("status", CompanyStatus::Verified);
    }
}
