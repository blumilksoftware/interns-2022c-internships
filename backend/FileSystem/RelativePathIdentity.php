<?php

declare(strict_types=1);

namespace Internships\FileSystem;

class RelativePathIdentity extends PathIdentity
{
    protected RelativePathIdentity $parentPath;
    protected string $leftBasePath;
    protected string $rightBasePath;
    protected string $relativeChangingPath;

    public function __construct(
        string $leftBasePath = "",
        string $rightBasePath = "",
        string $relativeChangingPath = "",
        string $sourceName = "",
        string $destinationName = ""
    ) {
        $this->leftBasePath = $leftBasePath;
        $this->rightBasePath = $rightBasePath;
        $this->setChangingPath($relativeChangingPath);
        $this->setSourceName($sourceName);
        $this->setDestinationName($destinationName);
    }

    public function getParentPath(): string
    {
        if (isset($this->parentPath)) {
            return $this->parentPath->getRelativePath();
        }

        return "";
    }

    public function getRelativePath(): string
    {
        return PathResolver::normalizeDirectorySeparators(
            path: $this->getParentPath()
                  . $this->leftBasePath
                  . $this->relativeChangingPath
                  . $this->rightBasePath
        );
    }

    public function setParentIdentity(self $parentPathIdentity): void
    {
        $this->parentPath = $parentPathIdentity;
    }

    public function setChangingPath(string $relativeChangingPath): void
    {
        $this->relativeChangingPath = PathResolver::addSeparatorsToDirectory($relativeChangingPath);
    }

    public function setDestinationName(string $destinationName): void
    {
        parent::setDestinationName($destinationName);
    }

    public function setSourceName(string $sourceName): void
    {
        parent::setSourceName($sourceName);
    }
}
