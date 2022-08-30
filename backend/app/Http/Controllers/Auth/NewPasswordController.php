<?php

declare(strict_types=1);

namespace Internships\Http\Controllers\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Internships\Http\Controllers\Controller;

class NewPasswordController extends Controller
{
    public function create(Request $request): Response
    {
        return Inertia::render("Auth/ResetPassword", [
            "email" => $request->email,
            "token" => $request->route("token"),
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "token" => "required",
            "email" => "required|email",
            "password" => ["required", "confirmed", Rules\Password::defaults()],
        ]);

        $status = Password::reset(
            $request->only("email", "password", "password_confirmation", "token"),
            function ($user) use ($request): void {
                $user->forceFill([
                    "password" => Hash::make($request->password),
                    "remember_token" => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            },
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route("login")->with("status", __($status));
        }

        throw ValidationException::withMessages([
            "email" => [trans($status)],
        ]);
    }
}
