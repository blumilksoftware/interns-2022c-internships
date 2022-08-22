<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Internships\Http\Controllers\GetLocationController;

Route::middleware("auth:sanctum")->get("/user", fn(Request $request) => $request->user());
Route::get("/location/{address}", GetLocationController::class);
