<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Internships\Http\Controllers\CompanyController;

require __DIR__ . "/auth.php";
Route::get("/", [CompanyController::class, "index"])->name("index");
Route::post("/company", [CompanyController::class, "store"])->name("company-store");

Route::get("/company/manage", [CompanyController::class, "manage"])->middleware(["auth"])->name("company-manage");
Route::get("/company/create", [CompanyController::class, "create"])->middleware(["auth", "verified"])->name("company-create");

Route::get("/company/view/{id}", [CompanyController::class, "show"])->name("company-show");
Route::delete('/company/view/{id}', [CompanyController::class, 'destroy'])
    ->name('index.destroy')
    ->middleware('auth');
Route::post('/company/view/{id}', [CompanyController::class, 'update'])
    ->name('index.update')
    ->middleware('auth');

Route::get("/company/close", [CompanyController::class, "close"])->name("company-close");