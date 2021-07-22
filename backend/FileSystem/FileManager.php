<?php

declare(strict_types=1);

namespace Internships\FileSystem;

use DI\NotFoundException;
use Exception;
use Internships\Exceptions\AlreadyExistsPathException;
use Internships\Exceptions\CouldNotReadPathException;
use Internships\Exceptions\IsNotDirectoryPathException;
use Internships\Helpers\OutputWriter;
use Internships\Services\UniquePathGuard;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class FileManager
{
    protected int $jsonPrintFlags = JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES;

    public function __construct(
        protected DirectoryManager $directoryManager,
        protected UniquePathGuard $pathGuard
    ) {
    }

    public function getDefaultJsonFlags(): int
    {
        return $this->jsonPrintFlags;
    }

    public function create(string $relativePath, string $filename = "", mixed $content = "", bool $noFile = false): void
    {
        $path = $this->directoryManager->getApiFilePath($relativePath, $filename);
        $this->pathGuard->verifyIfUnique($path);

        if (!$noFile) {
            file_put_contents(
                filename: $path,
                data: $content
            );
        } elseif ($filename === "") {
            throw new Exception(
                "Couldn't create file in {$relativePath}. No filename. Have you meant to create folder?"
            );
        }
    }

    public function appendNewLine(string $relativePath, string $filename, string $content = ""): void
    {
        if ($filename === "") {
            throw new Exception("Cannot append to file with no name.");
        }

        $path = $this->directoryManager->getApiFilePath($relativePath, $filename);

        file_put_contents(
            filename: $path,
            data: OutputWriter::newLine($content),
            flags: FILE_APPEND
        );
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

        $fullDestinationPath = $destination . $newName;
        $this->pathGuard->verifyIfUnique($fullDestinationPath);

        if (!$overwrite && file_exists($fullDestinationPath)) {
            throw new AlreadyExistsPathException($fullDestinationPath);
        } else {
            if(file_exists($origin)){
                throw new NotFoundException($origin . $filename);
            }
            if (!copy($origin . $filename, $fullDestinationPath)) {
                throw new CouldNotReadPathException("{$origin} and/or {$fullDestinationPath}");
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

            try {
                $this->copyResource($finalOrigin, $finalDestination, $fileName, overwrite: false, toResource: true);
            }
            catch(AlreadyExistsPathException $exception){
                OutputWriter::newLineToConsole("{$exception->getMessage()} Skipping.");
            }
        }
    }

    public function getResourceFilePathsFrom(
        string $relativeOrigin,
    ): array {
        $origin = $this->directoryManager->getResourceDirectoryPath($relativeOrigin);

        if (!is_dir(substr($origin, strlen($origin) - 1))) {
            throw new IsNotDirectoryPathException($origin);
        }
        if (!file_exists($origin)) {
            throw new NotFoundException($origin);
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
