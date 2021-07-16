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
        $fullPath = $this->root . self::FOLDER_SEPARATOR . $relativePath;
        if (!$isFile) {
            $fullPath .= self::FOLDER_SEPARATOR;
        }
        return $this->normalize($fullPath);
    }

    protected function normalize(string $path): string
    {
        return preg_replace("#/+#", self::FOLDER_SEPARATOR, $path);
    }
}
