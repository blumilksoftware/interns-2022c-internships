<?php

declare(strict_types=1);

namespace Internships\FileSystem;

class DirectoryManager
{
    protected const DIRECTORY_PERMISSIONS = 0777;
    protected const RECURSIVE_CREATION = true;

    protected Path $apiPath;
    protected Path $resourcePath;

    public function __construct(
        string $rootDirectoryPath,
        string $relativeApiPath,
        string $relativeResourcePath
    ) {
        $rootManager = new Path($rootDirectoryPath);
        $this->apiPath = new Path($rootManager->getFull($relativeApiPath));
        $this->resourcePath = new Path($rootManager->getFull($relativeResourcePath));
    }

    public function getApiDirectoryPath(string $relativePath): string
    {
        $directoryPath = $this->apiPath->getFull($relativePath);
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, static::DIRECTORY_PERMISSIONS, static::RECURSIVE_CREATION);
        }
        return $directoryPath;
    }

    public function getApiFilePath(string $relativePath, string $fileName): string
    {
        return $this->getApiDirectoryPath($relativePath) . $fileName;
    }

    public function getResourceDirectoryPath(string $relativePath): string
    {
        return $this->resourcePath->getFull($relativePath);
    }

    public function getResourceFilePath(string $relativePath, string $fileName): string
    {
        return $this->getResourceDirectoryPath($relativePath) . $fileName;
    }
}
