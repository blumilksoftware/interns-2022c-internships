<?php

declare(strict_types=1);
require __DIR__ . "/../vendor/autoload.php";

$root = __DIR__ . "/../";

use Dotenv\Dotenv;
use Internships\Application\Application;
use Internships\CommandLine\ConsoleWriter;
use Internships\CommandLine\OptionManager;

$dotenv = Dotenv::createImmutable($root);
$dotenv->load();

$container = require __DIR__ . "/Application/AppContainerBuilder.php";
$application = $container->get(Application::class);

$optionManager = new OptionManager();
$options = getopt(short_options: "", long_options: $optionManager->getCommands());

$applicationMethod = "";
if ($optionManager->getApplicationOption($options, $applicationMethod)) {
    $application->{$applicationMethod}();
    ConsoleWriter::success("Finished.");
}
