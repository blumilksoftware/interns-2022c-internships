<?php

declare(strict_types=1);
require __DIR__ . "/../vendor/autoload.php";

$root = __DIR__ . "/../";

use Dotenv\Dotenv;
use Internships\Application\Application;

$dotenv = Dotenv::createImmutable($root);
$dotenv->load();

$container = require __DIR__ . "/Application/AppContainerBuilder.php";
$application = $container->get(Application::class);
$options = getopt("rf");

if (array_key_exists("r", $options)) {
    $application->populate();
} elseif(array_key_exists("f", $options)) {
    $application->fetch();
} else {
    $application->build();
}

echo "Finished." . PHP_EOL;
