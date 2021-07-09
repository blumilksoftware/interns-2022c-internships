<?php

declare(strict_types=1);

namespace Internships\Application;

use Internships\FileSystem\FileManager;

class Application
{
    protected FileManager $fileManager;

    public function __construct(
        string $rootDirectoryPath,
        string $apiRelativePath
    ) {
        $this->fileManager = new FileManager($rootDirectoryPath, $apiRelativePath);
    }

    public function build(): void
    {
        $this->fileManager->create("/empty/");
        $this->fileManager->create("/test/", "phpversion.txt", PHP_VERSION);
        $this->fileManager->copy(
            "/resources/documents/wydzial-techniczny/",
            "/test",
            "example.txt",
            "testing.txt"
        );
    }
}
