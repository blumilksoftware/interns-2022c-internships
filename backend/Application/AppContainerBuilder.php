<?php

declare(strict_types=1);

use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . "/AppContainerDefinitions.php");
$container = $containerBuilder->build();

return $container;
