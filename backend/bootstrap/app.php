<?php

use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Contracts\Debug\ExceptionHandler as HandlerContract;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;
use Internships\Http\Kernel as HttpKernel;
use Internships\Console\Kernel as ConsoleKernel;
use Internships\Exceptions\Handler as ExceptionHandler;


$application = new Illuminate\Foundation\Application(
    basePath: dirname(__DIR__)
);

$application->useEnvironmentPath(dirname(__DIR__, 2));
$application->singleton(HttpKernelContract::class, HttpKernel::class);
$application->singleton(ConsoleKernelContract::class, ConsoleKernel::class);
$application->singleton(HandlerContract::class, ExceptionHandler::class);

return $application;
