<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;
use Internships\Models\User;

class AdminUsersController extends Controller
{
    public function users(Request $request): Response
    {
        $users = User::paginate(10);
        return inertia(
            "AdminPanel/UsersList",
            [
                "users" => $users,
            ],
        );
    }
}
