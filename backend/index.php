<?php

declare(strict_types=1);
require __DIR__ . "/../vendor/autoload.php";

use Internships\Application\Application;

$container = require __DIR__ . "/Application/AppContainerBuilder.php";
$application = $container->get(Application::class);

$options = getopt("r");

if (array_key_exists("r", $options)) {
    $application->populate();
} else {
    $application->build();
}

echo "Finished." . PHP_EOL;
