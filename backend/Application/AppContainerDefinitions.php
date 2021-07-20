<?php

use Internships\FileSystem\DirectoryManager;
use Internships\Services\UniquePathGuard;

use function DI\create;

return [
    DirectoryManager::class =>
        DI\autowire()->constructor(__DIR__ . "/../../", "/public/api/", "/resources/"),
    UniquePathGuard::class =>
        DI\autowire(),
];