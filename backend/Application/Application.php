<?php

declare(strict_types=1);

namespace Internships\Application;

use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;

class Application
{
    protected DirectoryManager $directoryManager;
    protected FileManager $fileManager;

    public function __construct(
        string $rootPath,
        string $apiRelativePath,
        string $resourceRelativePath
    ) {
        $this->directoryManager = new DirectoryManager($rootPath, $apiRelativePath, $resourceRelativePath);
        $this->fileManager = new FileManager($this->directoryManager);
    }

    public function build(): void
    {
        $this->fileManager->create("/empty/");
        $this->fileManager->create("/test/", "phpversion.txt", PHP_VERSION);
        $this->fileManager->copyResource(
            "/documents/wydzial-techniczny/",
            "/test",
            "example.txt",
            "testing.txt"
        );
    }
}
