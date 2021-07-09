<?php

declare(strict_types=1);

namespace Internships\FileSystem;

class DirectoryManager
{
    public function __construct(
        protected string $rootDirectoryPath,
        protected string $apiDirectory
    ) {
        $this->apiDirectory = $rootDirectoryPath . $apiDirectory;
    }

    public function getApiPath(string $relativePath): string
    {
        $directoryPath = $this->apiDirectory . $relativePath . "/";
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        return $directoryPath;
    }

    public function getRootPath(string $relativePath): string
    {
        return $this->rootDirectoryPath . $relativePath . "/";
    }
}
