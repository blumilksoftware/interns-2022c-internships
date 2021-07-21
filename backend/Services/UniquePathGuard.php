<?php

declare(strict_types=1);

namespace Internships\Services;

use Exception;

class UniquePathGuard
{
    protected array $paths = [];

    public function verifyIfUnique(string $newPath): void
    {
        foreach ($this->paths as $path) {
            if ($newPath === $path) {
                throw new Exception("Paths of created files are not unique.");
            }
        }
        array_push($this->paths, $newPath);
    }
}
