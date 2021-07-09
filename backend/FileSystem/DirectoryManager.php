<?php

declare(strict_types=1);

namespace Internships\FileSystem;

class DirectoryManager
{
    protected string $apiDirectory;

    public function __construct(
        string $rootDirectoryPath
    ) {
        $this->apiDirectory = $rootDirectoryPath . "/public/api/";
    }

    public function getFullPath(string $relativePath): string
    {
        $directoryPath = $this->apiDirectory . $relativePath;

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }
        return $directoryPath;
    }
}
