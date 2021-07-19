<?php

declare(strict_types=1);

namespace Internships\FileSystem;

class Path
{
    public const FOLDER_SEPARATOR = "/";

    public function __construct(
        protected string $root
    ) {
    }

    public function getFull($relativePath, bool $isFile = false): string
    {
        $fullPath = $this->root . static::FOLDER_SEPARATOR . $relativePath;
        if (!$isFile) {
            $fullPath .= static::FOLDER_SEPARATOR;
        }
        return $this->normalize($fullPath);
    }

    protected function normalize(string $path): string
    {
        return preg_replace("#/+#", static::FOLDER_SEPARATOR, $path);
    }
}
