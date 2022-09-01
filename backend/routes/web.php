<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Internships\Http\Controllers\CompanyBrowserController;
use Internships\Http\Controllers\CompanyController;

require __DIR__ . "/auth.php";
Route::get("/", [CompanyBrowserController::class, "index"])->name("index");

Route::get("/company", [CompanyController::class, "index"])->middleware(["auth"])->name("company-index");
Route::get("/company/create", [CompanyController::class, "create"])->middleware(["auth", "verified"])->name("company-create");
Route::post("/company", [CompanyController::class, "store"])->name("company-store");
