<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;

class AdminUsersController extends Controller
{
    public function users(Request $request): Response
    {
        return inertia(
            "AdminPanel/Users",
        );
    }
}
