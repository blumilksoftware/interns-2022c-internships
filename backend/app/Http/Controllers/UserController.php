<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;

class UserController extends Controller
{
    public function login(Request $request): Response
    {
        return inertia(
            "User/Login",
        );
    }
}
