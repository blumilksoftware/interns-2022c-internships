<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Internships\Http\Controllers\CompanyController;

require __DIR__ . "/auth.php";
Route::get("/", [CompanyController::class, "index"])->name("index");

Route::post("/company", [CompanyController::class, "store"])->name("company-store");
Route::get("/company/own", [CompanyController::class, "index"])->middleware(["auth"])->name("company-index");
Route::get("/company/create", [CompanyController::class, "create"])->middleware(["auth", "verified"])->name("company-create");
Route::get("/company/manage", [CompanyController::class, "index"])->middleware(["auth"])->name("company-manage");
Route::get("/company/view/{id}", [CompanyController::class, "show"])->name("index.show");
