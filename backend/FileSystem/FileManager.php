<?php

declare(strict_types=1);

namespace Internships\FileSystem;

use DirectoryIterator;
use Internships\Exceptions\File\NoNameFileException;
use Internships\Exceptions\Path\AlreadyExistsPathException;
use Internships\Exceptions\Path\CouldNotReadPathException;
use Internships\Exceptions\Path\IsNotDirectoryPathException;
use Internships\Exceptions\Path\NotFoundPathException;
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

    public function createInApi(
        string $relativePath,
        string $filename = "",
        mixed $content = "",
        bool $noFile = false
    ): void {
        $path = $this->directoryManager->getApiFilePath($relativePath, $filename);
        if ($noFile && $filename === "") {
            throw new NoNameFileException($path);
        }

        $this->create($path, $content);
    }

    public function createInResources(
        string $relativePath,
        string $filename = "",
        mixed $content = "",
        bool $noFile = false
    ): void {
        $path = $this->directoryManager->getResourceFilePath($relativePath, $filename);
        if ($noFile && $filename === "") {
            throw new NoNameFileException($path);
        }

        $this->create($path, $content);
    }

    public function appendNewLine(string $relativePath, string $filename, string $content = ""): void
    {
        $path = $this->directoryManager->getApiFilePath($relativePath, $filename);

        if ($filename === "") {
            throw new NoNameFileException($path);
        }

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
        }
        if (!file_exists($origin . $filename)) {
            throw new NotFoundPathException($origin . $filename);
        }
        if (!copy($origin . $filename, $fullDestinationPath)) {
            throw new CouldNotReadPathException("{$origin} and/or {$fullDestinationPath}");
        }
    }

    public function copyResources(
        /**
         * @var string[] $filePaths
         */
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
            } catch (AlreadyExistsPathException $exception) {
                OutputWriter::newLineToConsole("{$exception->getMessage()} Skipping.");
            }
        }
    }

    public function getResourceFilePathsFrom(
        string $relativeOrigin,
        string $specificFilename = "",
    ): array {
        $origin = $this->directoryManager->getResourceDirectoryPath($relativeOrigin);

        if (!is_dir(substr($origin, strlen($origin) - 1))) {
            throw new IsNotDirectoryPathException($origin);
        }
        if (!file_exists($origin)) {
            throw new NotFoundPathException($origin);
        }

        $recursiveIteratorI = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($origin));
        $filePaths = [];

        /** @var DirectoryIterator $file */
        foreach ($recursiveIteratorI as $file) {
            if (!$file->isDir()) {
                if ($file->getPath()[0]
                    && ($specificFilename === "" || $specificFilename === $file->getFilename())) {
                    array_push($filePaths, $file->getPathname());
                }
            }
        }
        return $filePaths;
    }

    protected function create(string $fullPath, mixed $content = ""): void
    {
        $this->pathGuard->verifyIfUnique($fullPath);
        file_put_contents(
            filename: $fullPath,
            data: $content
        );
    }
}
