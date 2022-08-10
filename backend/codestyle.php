<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\Paths;

$config = new Config(
    paths: new Paths("app", "static", "tests", "database", "bootstrap", "routes")
);

return $config->config();
