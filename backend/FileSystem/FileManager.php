<?php

declare(strict_types=1);

namespace Internships\FileSystem;

use Exception;

class FileManager
{
    public function __construct(
        protected DirectoryManager &$directoryManager
    ) {
    }

    public function create(string $relativePath, string $filename = "\0", mixed $content = ""): void
    {
        $path = $this->directoryManager->getApiPath($relativePath);

        if ($filename !== "\0") {
            file_put_contents(
                filename: $path . $filename,
                data: $content
            );
        }
    }

    public function copyResource(string $relativeOrigin, string $relativeDestination, $filename, $newName = "\0"): void
    {
        if ($newName === "\0") {
            $newName = $filename;
        }
        $destination = $this->directoryManager->getApiPath($relativeDestination);
        $origin = $this->directoryManager->getResourcePath($relativeOrigin);
        if (!copy($origin . $filename, $destination . $newName)) {
            throw new Exception("Couldn't copy. File " . $origin . $filename . " not found.");
        }
    }
}
