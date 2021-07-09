<?php

declare(strict_types=1);

namespace Internships\Application;

use Internships\FileSystem\FileManager;

class Application
{
    protected FileManager $fileManager;

    public function __construct(
        string $rootDirectoryPath
    ) {
        $this->fileManager = new FileManager($rootDirectoryPath);
    }

    public function build(): void
    {
        $this->fileManager->create("/test", "phpversion.txt", phpversion());
    }
}
