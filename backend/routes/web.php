<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Internships\Http\Controllers\CompanyBrowserController;

Route::get("/", [CompanyBrowserController::class, "index"]);
