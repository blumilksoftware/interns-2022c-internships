<?php

declare(strict_types=1);
$root = __DIR__ . "/../../";
require $root . "vendor/autoload.php";

use DI\Container;
use Dotenv\Dotenv;
use InternshipsStatic\Application\Application;
use InternshipsStatic\CommandLine\ConsoleWriter;
use InternshipsStatic\CommandLine\OptionManager;

/** @var Dotenv $dotenv */
$dotenv = Dotenv::createImmutable($root);
$dotenv->load();

/** @var Container $container */
$container = require __DIR__ . "/Application/AppContainerBuilder.php";

/** @var Application $application */
$application = $container->get(Application::class);

$optionManager = new OptionManager();
$options = getopt(short_options: "", long_options: $optionManager->getCommands());

$applicationMethod = "";
if ($optionManager->getApplicationOption($options, $applicationMethod)) {
    $application->{$applicationMethod}();
    ConsoleWriter::success("Finished. ");
}
