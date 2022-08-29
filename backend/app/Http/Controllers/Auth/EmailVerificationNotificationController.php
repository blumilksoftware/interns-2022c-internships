<?php

declare(strict_types=1);

namespace Internships\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Internships\Http\Controllers\Controller;
use Internships\Providers\RouteServiceProvider;

class EmailVerificationNotificationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with("status", "verification-link-sent");
    }
}
