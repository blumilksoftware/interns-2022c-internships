<?php

declare(strict_types=1);

namespace Internships\FileSystem;

class DirectoryManager
{

    public function __construct(
        protected string $apiDirectory
    ) {
        $this->apiDirectory = $apiDirectory . "/public/api/";
    }

    public function getApiPath(string $relativePath): string
    {
        $directoryPath = $this->apiDirectory . $relativePath . "/";

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }
        return $directoryPath;
    }
}
