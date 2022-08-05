<?php

declare(strict_types=1);

namespace InternshipsStatic\FileSystem;

class PathResolver
{
    public const FOLDER_SEPARATOR = "/";

    public function __construct(
        protected string $root,
    ) {}

    public function getFull($relativePath): string
    {
        $fullPath = $this->root . static::FOLDER_SEPARATOR . $relativePath;
        return static::normalizeDirectorySeparators($fullPath);
    }

    public static function normalizeDirectorySeparators(string $path, bool $isFile = false): string
    {
        $path = preg_replace(
            pattern: "#/+#",
            replacement: static::FOLDER_SEPARATOR,
            subject: static::FOLDER_SEPARATOR . $path . static::FOLDER_SEPARATOR,
        );
        if ($isFile) {
            $path = static::trimPathOfFile($path);
        }

        return $path;
    }

    public static function addSeparatorsToDirectory(string $path)
    {
        return static::normalizeDirectorySeparators(static::FOLDER_SEPARATOR . $path . static::FOLDER_SEPARATOR);
    }

    public static function trimFileName(string $path): string
    {
        return trim($path, static::FOLDER_SEPARATOR);
    }

    public static function trimPathOfFile(string $path): string
    {
        return rtrim($path, static::FOLDER_SEPARATOR);
    }
}
