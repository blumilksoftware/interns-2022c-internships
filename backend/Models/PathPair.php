<?php

declare(strict_types=1);

namespace Internships\Models;

class PathPair
{
    protected string $relativeRootPath;
    protected string $fileName;

    public function __construct(string $relativeRootPath, string $fileName)
    {
        $this->relativeRootPath = $relativeRootPath;
        $this->fileName = $fileName;
    }

    public function getRelativePath(): string
    {
        return $this->relativeRootPath;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }
}
