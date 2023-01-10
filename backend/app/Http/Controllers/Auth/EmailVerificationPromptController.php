<?php

declare(strict_types=1);

namespace Internships\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Internships\Http\Controllers\Controller;
use Internships\Providers\RouteServiceProvider;

class EmailVerificationPromptController extends Controller
{
    public function __invoke(Request $request): RedirectResponse|Response
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME)
                    : Inertia::render("Auth/VerifyEmail", ["status" => session("status")]);
    }
}
