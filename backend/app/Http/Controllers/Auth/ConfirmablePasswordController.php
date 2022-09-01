<?php

declare(strict_types=1);

namespace Internships\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Internships\Http\Controllers\Controller;
use Internships\Providers\RouteServiceProvider;

class ConfirmablePasswordController extends Controller
{
    public function show(): Response
    {
        return Inertia::render("Auth/ConfirmPassword");
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if (!Auth::guard("web")->validate([
            "email" => $request->user()->email,
            "password" => $request->password,
        ])) {
            throw ValidationException::withMessages([
                "password" => __("auth.password"),
            ]);
        }

        $request->session()->put("auth.password_confirmed_at", time());

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
