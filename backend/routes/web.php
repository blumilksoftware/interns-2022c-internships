<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Internships\Http\Controllers\AdminCompaniesController;
use Internships\Http\Controllers\AdminUsersController;
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
Route::patch("/company/view/{company}", [CompanyController::class, "verify"])
    ->name("company-verify")
    ->middleware("auth");

Route::get("/company/close", [CompanyController::class, "close"])
    ->name("company-close");

Route::get("/admin/users", [AdminUsersController::class, "users"])
    ->middleware(["auth"])
    ->name("admin-users");
Route::delete("/admin/users/{user}", [AdminUsersController::class, "delete"])
    ->middleware(["auth"])
    ->name("admin-users-delete");
Route::get("/admin/users/trashed", [AdminUsersController::class, "trashed"])
    ->middleware(["auth"])
    ->name("admin-trashed-users");
Route::put("/admin/users/trashed/{id}", [AdminUsersController::class, "restore"])
    ->middleware(["auth"])
    ->name("admin-trashed-users-restore");

Route::get("/admin/companies", [AdminCompaniesController::class, "companies"])
    ->middleware(["auth"])
    ->name("admin-companies");
Route::put("/admin/companies/{company}", [AdminCompaniesController::class, "update"])
    ->middleware(["auth"])
    ->name("admin-companies-update");
Route::get("/admin/companies/edit/{company}", [AdminCompaniesController::class, "show"])
    ->middleware(["auth"])
    ->name("admin-companies-edit");
Route::put("/admin/companies/edit/{company}", [AdminCompaniesController::class, "store"])
    ->middleware(["auth"])
    ->name("admin-companies-store");
Route::delete("/admin/companies/{company}", [AdminCompaniesController::class, "delete"])
    ->middleware(["auth"]) 
    ->name("admin-companies-delete");
Route::get("/admin/companies/trashed", [AdminCompaniesController::class, "trashed"])
    ->middleware(["auth"])
    ->name("admin-trashed-companies");
Route::put("/admin/companies/trashed/{id}", [AdminCompaniesController::class, "restore"])
    ->middleware(["auth"])
    ->name("admin-trashed-companies-restore");
