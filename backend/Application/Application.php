<?php

declare(strict_types=1);

namespace Internships\Application;

use Internships\FileSystem\DirectoryManager;

class Application
{
    protected DirectoryManager $directoryManager;

    public function __construct(
        protected string $rootDirectoryPath
    ) {
        $this->directoryManager = new DirectoryManager($rootDirectoryPath);
    }

    public function build(): void
    {
        echo $this->directoryManager->getFullPath("");
    }
}
