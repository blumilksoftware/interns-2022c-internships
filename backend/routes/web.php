<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Internships\Http\Controllers\CompanyController;
use Internships\Http\Controllers\AdminPanelController;
use Internships\Http\Controllers\AdminCompaniesController;
use Internships\Http\Controllers\AdminUsersController;
use Internships\Http\Controllers\AdminTrashedController;



require __DIR__ . "/auth.php";
Route::get("/", [CompanyController::class, "index"])->name("index");

Route::post("/company", [CompanyController::class, "store"])->name("company-store");
Route::get("/company/own", [CompanyController::class, "index"])->middleware(["auth"])->name("company-index");
Route::get("/company/create", [CompanyController::class, "create"])->middleware(["auth", "verified"])->name("company-create");
Route::get("/company/manage", [CompanyController::class, "index"])->middleware(["auth"])->name("company-manage");
Route::get("/company/view/{id}", [CompanyController::class, "show"])->name("index.show");
Route::get("/admin",[AdminPanelController::class, "index"])->middleware(["auth"])->name("admin-index");
Route::get("/admin/companies",[AdminCompaniesController::class, "companies"])->middleware(["auth"])->name("admin-companies");
Route::put("/admin/companies/{company}",[AdminCompaniesController::class, "update"])->middleware(["auth"])->name("admin-companies-update");
Route::delete("/admin/companies/{company}",[AdminCompaniesController::class, "delete"])->middleware(["auth"])->name("admin-companies-delete");
Route::get("/admin/users",[AdminUsersController::class, "users"])->middleware(["auth"])->name("admin-users");
Route::delete("/admin/users/{user}",[AdminUsersController::class, "delete"])->middleware(["auth"])->name("admin-users-delete");
Route::get("/admin/trashed",[AdminTrashedController::class, "trashed"])->middleware(["auth"])->name("admin-trashed");
Route::put("/admin/trashed/{user}",[AdminUsersController::class, "restore"])->middleware(["auth"])->name("admin-trashed-users");
Route::put("/admin/trashed/{company}",[AdminCompaniesController::class, "restore"])->middleware(["auth"])->name("admin-trashed-companies");

