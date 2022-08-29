<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Internships\Http\Controllers\Auth\AuthenticatedSessionController;
use Internships\Http\Controllers\Auth\ConfirmablePasswordController;
use Internships\Http\Controllers\Auth\EmailVerificationNotificationController;
use Internships\Http\Controllers\Auth\EmailVerificationPromptController;
use Internships\Http\Controllers\Auth\NewPasswordController;
use Internships\Http\Controllers\Auth\PasswordResetLinkController;
use Internships\Http\Controllers\Auth\RegisteredUserController;
use Internships\Http\Controllers\Auth\VerifyEmailController;

Route::middleware("guest")->group(function (): void {
    Route::get("register", [RegisteredUserController::class, "create"])
        ->name("register");

    Route::post("register", [RegisteredUserController::class, "store"]);

    Route::get("login", [AuthenticatedSessionController::class, "create"])
        ->name("login");

    Route::post("login", [AuthenticatedSessionController::class, "store"]);

    Route::get("forgot-password", [PasswordResetLinkController::class, "create"])
        ->name("password.request");

    Route::post("forgot-password", [PasswordResetLinkController::class, "store"])
        ->name("password.email");

    Route::get("reset-password/{token}", [NewPasswordController::class, "create"])
        ->name("password.reset");

    Route::post("reset-password", [NewPasswordController::class, "store"])
        ->name("password.update");
});

Route::middleware("auth")->group(function (): void {
    Route::get("verify-email", [EmailVerificationPromptController::class, "__invoke"])
        ->name("verification.notice");

    Route::get("verify-email/{id}/{hash}", [VerifyEmailController::class, "__invoke"])
        ->middleware(["signed", "throttle:6,1"])
        ->name("verification.verify");

    Route::post("email/verification-notification", [EmailVerificationNotificationController::class, "store"])
        ->middleware("throttle:6,1")
        ->name("verification.send");

    Route::get("confirm-password", [ConfirmablePasswordController::class, "show"])
        ->name("password.confirm");

    Route::post("confirm-password", [ConfirmablePasswordController::class, "store"]);

    Route::post("logout", [AuthenticatedSessionController::class, "destroy"])
        ->name("logout");
});
