<?php

declare(strict_types=1);

namespace Internships\Models;

class PathPair
{
    protected string $relativePath;
    protected string $fileName;

    public function __construct(string $relativePath, string $fileName)
    {
        $this->relativePath = $relativePath;
        $this->fileName = $fileName;
    }

    public function getRelativePath(): string
    {
        return $this->relativePath;
    }
    public function getFileName(): string
    {
        return $this->fileName;
    }
}
