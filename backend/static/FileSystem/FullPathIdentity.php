<?php

declare(strict_types=1);

namespace InternshipsStatic\FileSystem;

class FullPathIdentity extends PathIdentity
{
    protected string $fullSourceFilePath;
    protected string $fullDestinationFilePath;

    public function __construct(
        protected string $fullSourcePath = "",
        protected string $fullDestinationPath = "",
        string $sourceName = "",
        string $destinationName = "",
    ) {
        $this->sourceName = PathResolver::trimFileName($sourceName);
        $this->destinationName = PathResolver::trimFileName($destinationName);
        $this->fullSourceFilePath = PathResolver::normalizeDirectorySeparators(
            $this->fullSourcePath
            . PathResolver::FOLDER_SEPARATOR
            . $this->sourceName,
            isFile: $sourceName !== "",
        );
        $this->fullDestinationFilePath = PathResolver::normalizeDirectorySeparators(
            $this->fullDestinationPath
            . PathResolver::FOLDER_SEPARATOR
            . $this->destinationName,
            isFile: $destinationName !== "",
        );
    }

    public function getFullSourcePath(): string
    {
        return $this->fullSourcePath;
    }

    public function getFullDestinationPath(): string
    {
        return $this->fullDestinationPath;
    }

    public function getFullSourceFilePath(): string
    {
        return $this->fullSourceFilePath;
    }

    public function getFullDestinationFilePath(): string
    {
        return $this->fullDestinationFilePath;
    }
}
