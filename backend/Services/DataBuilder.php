<?php

declare(strict_types=1);

namespace Internships\Services;

use ECSPrefix20210708\Nette\Neon\Exception;
use Internships\Interfaces\BuildTool;
use Internships\Models\PathPair;

abstract class DataBuilder implements BuildTool
{
    protected string $workingDirectory;
    protected static array $paths = [];
    public function __construct(PathPair $source, PathPair $destination)
    {
        foreach (self::$paths as $path) {
            if ($path->getFileName() === $source->getFileName()
                && $path->getRelativePath() === $source->getRelativePath()) {
                throw new Exception("Path sources in builders are not unique.");
            }
            if ($path->getFileName() === $destination->getFileName()
                && $path->getRelativePath() === $destination->getRelativePath()) {
                throw new Exception("Path destinations in builders are not unique.");
            }
            array_push(self::$paths, $source, $destination);
        }
    }

    public function setWorkingDirectory(string $workingDirectory): void
    {
        $this->workingDirectory = $workingDirectory;
    }
}
