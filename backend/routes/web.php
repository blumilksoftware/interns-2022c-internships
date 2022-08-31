<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Internships\Http\Controllers\CompanyBrowserController;
use Internships\Http\Controllers\CompanyController;
use Internships\Http\Controllers\UserController;
use Internships\Http\Controllers\AdminPanelController;
use Internships\Http\Controllers\AdminCompaniesController;
use Internships\Http\Controllers\AdminUsersController;

Route::get("/", [CompanyBrowserController::class, "index"]);

Route::get("/company/create", [CompanyController::class, "create"]);

Route::get("/login", [UserController::class, "login"]);
Route::get("/register", [UserController::class, "register"]);
Route::get("/admin",[AdminPanelController::class, "index"]);
Route::get("/admin/companies",[AdminCompaniesController::class, "companies"]);
Route::get("/admin/users",[AdminUsersController::class, "users"]);

