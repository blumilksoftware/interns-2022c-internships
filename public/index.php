<?php

declare(strict_types=1);

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define("LARAVEL_START", microtime(true));

if (file_exists(__DIR__ . "/../backend/storage/framework/maintenance.php")) {
    require __DIR__ . "/../backend/storage/framework/maintenance.php";
}

require __DIR__ . "/../backend/vendor/autoload.php";

$app = require_once __DIR__ . "/../backend/bootstrap/app.php";
$app->bind('path.public', function() { return __DIR__; });

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture(),
)->send();

$kernel->terminate($request, $response);
