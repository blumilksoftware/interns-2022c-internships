<?php

declare(strict_types=1);

use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Contracts\Debug\ExceptionHandler as HandlerContract;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;
use Internships\Console\Kernel as ConsoleKernel;
use Internships\Exceptions\ExceptionHandler;
use Internships\Http\Kernel as HttpKernel;

$application = new Illuminate\Foundation\Application(dirname(__DIR__));

$application->singleton(HttpKernelContract::class, HttpKernel::class);
$application->singleton(ConsoleKernelContract::class, ConsoleKernel::class);
$application->singleton(HandlerContract::class, ExceptionHandler::class);

return $application;
