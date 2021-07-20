<?php

declare(strict_types=1);

use Internships\FileSystem\DirectoryManager;

return [
    DirectoryManager::class =>
        DI\autowire()->constructor(__DIR__ . "/../../", "/public/api/", "/resources/"),
];
