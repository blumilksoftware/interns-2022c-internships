<?php

declare(strict_types=1);

namespace Internships\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Internships\Enums\Role;
use Internships\Http\Controllers\Controller;
use Internships\Http\Requests\Auth\RegisteredUserRequest;
use Internships\Models\User;
use Internships\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    public function create(): Response
    {
        return Inertia::render("Auth/Register");
    }

    /**
     * @throws ValidationException
     */
    public function store(RegisteredUserRequest $request): RedirectResponse
    {
        $user = User::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => Role::Company,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
