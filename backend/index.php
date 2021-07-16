<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";

use Internships\Application\Application;

$rootDirectory = __DIR__ . "/../";
$options = getopt("r");

$application = new Application($rootDirectory, "/public/api/", "/resources/");

if (array_key_exists("r", $options)) {
    $application->populate();
} else {
    $application->build();
}
