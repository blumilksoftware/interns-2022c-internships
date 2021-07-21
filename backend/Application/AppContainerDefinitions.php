<?php

declare(strict_types=1);

use Internships\FileSystem\DirectoryManager;

return [
    DirectoryManager::class => DI\autowire()
        ->constructorParameter("rootDirectoryPath", __DIR__ . "/../../")
        ->constructorParameter("relativeApiPath", "/public/api/")
        ->constructorParameter("relativeResourcePath", "/resources/"),
];
