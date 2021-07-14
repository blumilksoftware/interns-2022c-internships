<?php

declare(strict_types=1);

namespace Internships\FileSystem;

class Path
{
    public function __construct(
        protected string $root
    ) {
    }

    public function getFull($relativePath, bool $isFile = false): string
    {
        $fullPath = $this->root . "/" . $relativePath;
        if(!$isFile){
            $fullPath .= "/";
        }
        return $this->normalize($fullPath);
    }

    protected function normalize(string $path): string
    {
        return preg_replace("#/+#", "/", $path);
    }
}
