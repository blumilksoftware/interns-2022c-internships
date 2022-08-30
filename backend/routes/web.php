<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Internships\Http\Controllers\CompanyBrowserController;
use Internships\Http\Controllers\CompanyController;
use Internships\Http\Controllers\UserController;

Route::get("/", [CompanyBrowserController::class, "index"]);

Route::get("/company/create", [CompanyController::class, "create"]);

Route::get("/login", [UserController::class, "login"]);
Route::get("/register", [UserController::class, "register"]);
Route::get("/adminpanel",[AdminPanelController::class, "adminpanel"]);