<?php

declare(strict_types=1);

namespace Internships\FileSystem;

use Exception;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

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
        string $newName = null,
        bool $overwrite = true,
        bool $toResource = false,
    ): void {
        if ($newName === null) {
            $newName = $filename;
        }
        $origin = $this->directoryManager->getResourceDirectoryPath($relativeOrigin);
        if (!$toResource) {
            $destination = $this->directoryManager->getApiDirectoryPath($relativeDestination);
        } else {
            $destination = $this->directoryManager->getResourceDirectoryPath($relativeDestination, true);
        }
        if (!$overwrite && file_exists($destination . $filename)) {
            echo "Skipped copying " . $destination . $filename . ". File already exists." . PHP_EOL;
        } else {
            if (!copy($origin . $filename, $destination . $newName)) {
                throw new Exception("Couldn't copy. File " . $origin . $filename . " not found.");
            }
        }
    }

    public function copyResources(
        string $relativeOrigin,
        string $relativeDestination,
        array $filePaths,
    ): void {
        $baseResourcePath = $this->directoryManager->getResourceDirectoryPath($relativeOrigin);
        foreach ($filePaths as $filePath) {
            $fileName = basename($filePath);
            $path = substr($filePath, 0, strlen($filePath) - strlen($fileName));
            $fileRelativePath = Path::FOLDER_SEPARATOR . substr($path, strlen($baseResourcePath))
                . Path::FOLDER_SEPARATOR;
            $finalOrigin = $relativeOrigin . $fileRelativePath;
            $finalDestination = $relativeDestination . $fileRelativePath;
            //var_dump($finalOrigin, $finalDestination, $fileName);
            $this->copyResource($finalOrigin, $finalDestination, $fileName, overwrite: false, toResource: true);
        }
    }

    public function getResourceFilePathsFrom(
        string $relativeOrigin,
    ): array {
        $origin = $this->directoryManager->getResourceDirectoryPath($relativeOrigin);
        if (!is_dir(substr($origin, strlen($origin) - 1))) {
            throw new Exception($origin . " is not a directory.");
        }
        if (!file_exists($origin)) {
            throw new Exception("Directory. " . $origin . " not found.");
        }

        $recursiveIteratorI = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($origin));
        $filePaths = [];
        foreach ($recursiveIteratorI as $file) {
            if (!$file->isDir()) {
                if ($file->getPath()[0]) {
                    array_push($filePaths, $file->getPathname());
                }
            }
        }
        return $filePaths;
    }
}
