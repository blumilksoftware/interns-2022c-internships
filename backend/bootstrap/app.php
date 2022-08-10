<?php

use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Contracts\Debug\ExceptionHandler as HandlerContract;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;
use Internships\Http\Kernel as HttpKernel;
use Internships\Console\Kernel as ConsoleKernel;
use Internships\Exceptions\Handler as ExceptionHandler;


$application = new Illuminate\Foundation\Application(
    dirname(__DIR__)
);

$application->useEnvironmentPath(dirname(__DIR__, 2));
$application->useStoragePath(dirname(__DIR__) . "/storage");
$application->useLangPath(dirname(__DIR__) . "/lang");
$application->useDatabasePath(dirname(__DIR__) . "/database");

$application->singleton(HttpKernelContract::class, HttpKernel::class);
$application->singleton(ConsoleKernelContract::class, ConsoleKernel::class);
$application->singleton(HandlerContract::class, ExceptionHandler::class);

return $application;
