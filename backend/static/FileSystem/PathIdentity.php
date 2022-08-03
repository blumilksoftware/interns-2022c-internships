<?php

declare(strict_types=1);

namespace InternshipsStatic\FileSystem;

class PathIdentity
{
    protected string $sourceName;
    protected string $destinationName;

    public function getSourceName(): string
    {
        return $this->sourceName;
    }

    public function getDestinationName(): string
    {
        return $this->destinationName;
    }

    protected function setDestinationName(string $destinationName): void
    {
        $this->destinationName = PathResolver::trimFileName($destinationName);
    }

    protected function setSourceName(string $sourceName): void
    {
        $this->sourceName = PathResolver::trimFileName($sourceName);
    }
}
