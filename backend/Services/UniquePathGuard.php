<?php

declare(strict_types=1);

namespace Internships\Services;

use Exception;
use Internships\Models\PathPair;

class UniquePathGuard
{
    protected array $paths = [];

    public function createPathPair(string $relativePath, string $fileName): PathPair
    {
        $newPair = new PathPair($relativePath, $fileName);
        foreach ($this->paths as $path) {
            if ($path->getFileName() === $newPair->getFileName()
                && $path->getRelativePath() === $newPair->getRelativePath()) {
                throw new Exception("Constant paths in builders are not unique.");
            }
        }
        array_push($this->paths, $newPair);
        return $newPair;
    }
}
