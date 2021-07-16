<?php

declare(strict_types=1);

namespace Internships\FileSystem;

use Exception;

class FileManager
{
    public function __construct(
        protected DirectoryManager $directoryManager
    ) {
    }

    public function create(string $relativePath, string $filename = "", mixed $content = "", bool $noFile = false): void
    {
        $path = $this->directoryManager->getApiDirectoryPath($relativePath);
        if (!$noFile) {
            file_put_contents(
                filename: $path . $filename,
                data: $content
            );
        } elseif ($filename === "") {
            throw new Exception(
                "Couldn't create file in " . $relativePath
                . " No filename. Have you meant to create folder?"
            );
        }
    }

    public function copyResource(
        string $relativeOrigin,
        string $relativeDestination,
        string $filename,
        string $newName = null
    ): void {
        if ($newName !== null) {
            $newName = $filename;
        }
        $destination = $this->directoryManager->getApiDirectoryPath($relativeDestination);
        $origin = $this->directoryManager->getResourceDirectoryPath($relativeOrigin);
        if (!copy($origin . $filename, $destination . $newName)) {
            throw new Exception("Couldn't copy. File " . $origin . $filename . " not found.");
        }
    }
}
