<?php

declare(strict_types=1);

namespace Internships\Services;

use ECSPrefix20210708\Nette\Neon\Exception;
use Internships\Interfaces\BuildTool;
use Internships\Models\PathPair;

abstract class Builder implements BuildTool
{
    protected string $workingDirectory;
    protected static array $paths = [];
    public function __construct(PathPair $source, PathPair $destination)
    {
        if (in_array($source, self::$paths, true)) {
            throw new Exception("Path sources in builders are not unique.");
        }
        if (in_array($destination, self::$paths, true)) {
            throw new Exception("Path destinations in builders are not unique.");
        }
        array_push(self::$paths, $source, $destination);
    }

    public function setWorkingDirectory(string $workingDirectory): void
    {
        $this->workingDirectory = $workingDirectory;
    }
}
