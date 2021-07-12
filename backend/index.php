<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";

use Internships\Application\Application;

$rootDirectory = __DIR__ . "/../";

$application = new Application($rootDirectory, "/public/api/", "/resources/");
$application->build();
