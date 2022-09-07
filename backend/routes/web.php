<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Internships\Http\Controllers\CompanyController;

require __DIR__ . "/auth.php";
Route::get("/", [CompanyController::class, "index"])
    ->name("index");

Route::get("/company/create", [CompanyController::class, "create"])
    ->middleware(["auth", "verified"])
    ->name("company-create");
Route::post("/company/create", [CompanyController::class, "store"])
    ->name("company-store");

Route::get("/company/manage", [CompanyController::class, "manage"])
    ->middleware("auth")
    ->name("company-manage");

Route::get("/company/view/{company}", [CompanyController::class, "show"])
    ->name("company-show");
Route::delete("/company/view/{company}", [CompanyController::class, "delete"])
    ->name("company-delete")
    ->middleware("auth");
Route::post("/company/view/{company}", [CompanyController::class, "verify"])
    ->name("company-verify")
    ->middleware("auth");

Route::get("/company/close", [CompanyController::class, "close"])
    ->name("company-close");
