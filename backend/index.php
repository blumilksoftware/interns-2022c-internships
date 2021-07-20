<?php

declare(strict_types=1);

use Internships\Application\Application;

$container = require __DIR__ . "/Application/AppContainerBuilder.php";
$application = $container->get(Application::class);
//$rootDirectory = __DIR__ . "/../../";
$options = getopt("r");

//$application = new Application();
//$application->injectContainer($container);

