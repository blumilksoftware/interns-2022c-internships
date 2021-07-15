<?php

declare(strict_types=1);

namespace Internships\FileSystem;

define("PATHS_FOLDER_SEPARATOR", "/");

class Path
{
    public function __construct(
        protected string $root
    ) {
    }

    public function getFull($relativePath, bool $isFile = false): string
    {
        $fullPath = $this->root . PATHS_FOLDER_SEPARATOR . $relativePath;
        if (!$isFile) {
            $fullPath .= PATHS_FOLDER_SEPARATOR;
        }
        return $this->normalize($fullPath);
    }

    protected function normalize(string $path): string
    {
        return preg_replace("#/+#", PATHS_FOLDER_SEPARATOR, $path);
    }
}
