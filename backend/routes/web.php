<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Internships\Http\Controllers\CompanyBrowserController;
use Internships\Http\Controllers\CompanyController;
use Internships\Http\Controllers\AdminPanelController;
use Internships\Http\Controllers\AdminCompaniesController;
use Internships\Http\Controllers\AdminUsersController;


require __DIR__ . "/auth.php";
Route::get("/", [CompanyBrowserController::class, "index"])->name("index");
Route::get("/company/create", [CompanyController::class, "create"])->middleware(["auth"])->name("create-company");
Route::get("/admin",[AdminPanelController::class, "index"])->middleware(["auth"])->name("admin");
Route::get("/admin/companies",[AdminCompaniesController::class, "companies"]);
Route::get("/admin/users",[AdminUsersController::class, "users"]);
