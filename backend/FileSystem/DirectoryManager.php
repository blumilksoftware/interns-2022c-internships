<?php

declare(strict_types=1);

namespace Internships\FileSystem;

class DirectoryManager
{
    protected Path $apiPathManager;
    protected Path $resourcePathManager;

    public function __construct(
        string $rootDirectoryPath,
        string $relativeApiPath,
        string $relativeResourcePath
    ) {
        $rootManager = new Path($rootDirectoryPath);
        $this->apiPathManager = new Path($rootManager->getFull($relativeApiPath));
        $this->resourcePathManager = new Path($rootManager->getFull($relativeResourcePath));
    }

    public function getApiPath(string $relativePath): string
    {
        $directoryPath = $this->apiPathManager->getFull($relativePath);
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        return $directoryPath;
    }

    public function getResourcesPath(string $relativePath): string
    {
        return $this->resourcePathManager->getFull($relativePath);
    }
}
