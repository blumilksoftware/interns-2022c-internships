<?php


namespace Internships\Services;


use ECSPrefix20210708\Nette\Neon\Exception;
use Internships\Models\PathPair;

class UniquePathGuard
{
    protected array $paths = [];

    public function createPathPair(string $relativePath, string $fileName): PathPair{
        $newPair = new PathPair($relativePath, $fileName);
        foreach ($this->paths as $path) {
            if ($path->getFileName() === $newPair->getFileName()
                && $path->getRelativePath() === $newPair->getRelativePath()) {
                throw new Exception("Static paths in builders are not unique.");
            }
        }
        array_push($this->paths, $newPair);
        return $newPair;
    }
}
