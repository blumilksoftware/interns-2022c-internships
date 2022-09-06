<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;
use Internships\Models\Company;
use Internships\Models\User;
use Internships\Http\Resources\CompanyResource;
use Internships\Http\Resources\UserResource;

class AdminTrashedController extends Controller
{
    public function trashed(Request $request): Response
    {
        $companies = Company::onlyTrashed();
        $users = User::onlyTrashed();
        
        return inertia(
            "AdminPanel/TrashedList",
            [
                'companies'=> CompanyResource::collection($companies->get()),
                'users'=> UserResource::collection($users->get()),
            ],
           
        );
        
    }
}
