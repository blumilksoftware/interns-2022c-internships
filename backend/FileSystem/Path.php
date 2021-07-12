<?php


namespace Internships\FileSystem;


class Path
{
    public function __construct(protected string $root)
    {
    }

    protected function normalize(string $path) : string
    {
        return preg_replace('#/+#','/',$path);
    }

    public function getFull($relativePath) : string{
        $fullPath = $this->root . "/" . $relativePath . "/";
        return $this->normalize($fullPath);
    }
}