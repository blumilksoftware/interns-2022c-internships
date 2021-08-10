<?php

declare(strict_types=1);
require __DIR__ . "/../vendor/autoload.php";

$root = __DIR__ . "/../";

use Dotenv\Dotenv;
use Internships\Application\Application;
use Internships\CommandLine\ConsoleWriter;

$dotenv = Dotenv::createImmutable($root);
$dotenv->load();

$container = require __DIR__ . "/Application/AppContainerBuilder.php";
$application = $container->get(Application::class);
$options = getopt(short_options: "", long_options: ["populate", "fetch"]);

if (array_key_exists("populate", $options)) {
    $application->populate();
} elseif (array_key_exists("fetch", $options)) {
    $application->fetch();
} else {
    $application->build();
}

ConsoleWriter::success("Finished.");
