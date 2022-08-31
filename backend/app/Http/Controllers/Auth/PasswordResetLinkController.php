<?php

declare(strict_types=1);

namespace Internships\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Internships\Http\Controllers\Controller;
use Internships\Http\Requests\Auth\PasswordResetLinkRequest;

class PasswordResetLinkController extends Controller
{
    public function create(): Response
    {
        return Inertia::render("Auth/ForgotPassword", [
            "status" => session("status"),
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function store(PasswordResetLinkRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink(
            $request->only("email"),
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with("status", __($status));
        }

        throw ValidationException::withMessages([
            "email" => [trans($status)],
        ]);
    }
}
