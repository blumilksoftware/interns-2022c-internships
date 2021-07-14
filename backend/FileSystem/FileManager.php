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

    public function create(string $relativePath, string $filename = "", mixed $content = ""): void
    {
        $path = $this->directoryManager->getApiDirectoryPath($relativePath);

        if ($filename !== "") {
            file_put_contents(
                filename: $path . $filename,
                data: $content
            );
        }
    }

    public function copyResource(
        string $relativeOrigin,
        string $relativeDestination,
        string $filename,
        string $newName = ""
    ): void {
        if ($newName === "") {
            $newName = $filename;
        }
        $destination = $this->directoryManager->getApiDirectoryPath($relativeDestination);
        $origin = $this->directoryManager->getResourceDirectoryPath($relativeOrigin);
        if (!copy($origin . $filename, $destination . $newName)) {
            throw new Exception("Couldn't copy. File " . $origin . $filename . " not found.");
        }
    }
}
