<?php

declare(strict_types=1);

namespace Internships\Services;

use Internships\Exceptions\Path\NotUniquePathException;

class UniquePathGuard
{
    /** @var array<string> */
    protected array $paths = [];

    public function verifyIfUnique(string $newPath): void
    {
        foreach ($this->paths as $path) {
            if ($newPath === $path) {
                throw new NotUniquePathException($newPath);
            }
        }
        array_push($this->paths, $newPath);
    }
}
