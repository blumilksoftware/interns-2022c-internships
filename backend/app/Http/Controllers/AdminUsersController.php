<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Request;
use Inertia\Response;
use Internships\Models\User;
use Internships\Http\Resources\UserResource;

class AdminUsersController extends Controller
{
    public function users(): Response   
    {
        $usersQuery = User::query()->orderBy("role")->orderBy("last_name");
        $usersSearch = $usersQuery->when(Request::input("search"), function ($query, $search): void {
            $query->where("first_name", "like", "%" . $search . "%")->orWhere("last_name", "like", "%" . $search . "%");
        });
        

        return inertia(
            "AdminPanel/UsersList",
            [
                "users" => UserResource::collection($usersSearch->paginate(10)->withQueryString(),),
                "filter" => Request::all("search"),
            ],
        );
    }
    public function delete(user $user)
    {
        $user->delete();
        return redirect()->route('admin-users')->with('message', 'User delete successfully');

    }
    public function restore(User $user)
    {
        $user->restore();
        return redirect()->route('admin-trashed')->with('message', 'User restored successfully');

    }
}
