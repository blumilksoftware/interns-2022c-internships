<?php

use DI\ContainerBuilder;
use Internships\Application\Application;

require __DIR__ . "/../../vendor/autoload.php";

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions(__DIR__ . '/AppContainerDefinitions.php');
$container = $containerBuilder->build();

return $container;