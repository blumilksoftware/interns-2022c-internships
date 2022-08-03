<?php

declare(strict_types=1);

namespace InternshipsStatic\FileSystem;

class DirectoryManager
{
    protected const DIRECTORY_PERMISSIONS = 0777;
    protected const RECURSIVE_CREATION = true;

    protected PathResolver $apiPath;
    protected PathResolver $resourcePath;

    public function __construct(
        string $rootDirectoryPath,
        string $relativeApiPath,
        string $relativeResourcePath,
    ) {
        $rootPath = new PathResolver($rootDirectoryPath);
        $this->apiPath = new PathResolver($rootPath->getFull($relativeApiPath));
        $this->resourcePath = new PathResolver($rootPath->getFull($relativeResourcePath));
    }

    public function getApiPath(): string
    {
        return $this->apiPath->getFull(relativePath:"");
    }

    public function getResourcePath(): string
    {
        return $this->resourcePath->getFull(relativePath:"");
    }

    public function getFullPathIdentity(RelativePathIdentity $relativeIdentity, bool $destinationToResource = false)
    {
        $destinationPathResolver = $this->apiPath;
        if ($destinationToResource) {
            $relativeIdentity = clone $relativeIdentity;
            $relativeIdentity->setDestinationName($relativeIdentity->getSourceName());
            $destinationPathResolver = $this->resourcePath;
        }
        $destinationPath = $destinationPathResolver->getFull($relativeIdentity->getRelativePath());
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, static::DIRECTORY_PERMISSIONS, static::RECURSIVE_CREATION);
        }

        return new FullPathIdentity(
            fullSourcePath: $this->resourcePath->getFull($relativeIdentity->getRelativePath()),
            fullDestinationPath: $destinationPath,
            sourceName: $relativeIdentity->getSourceName(),
            destinationName: $relativeIdentity->getDestinationName(),
        );
    }
}
