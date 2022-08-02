<?php

declare(strict_types=1);

namespace Internships\FileSystem;

use DirectoryIterator;
use Internships\CommandLine\ConsoleWriter;
use Internships\Exceptions\File\NoNameFileException;
use Internships\Exceptions\Path\AlreadyExistsPathException;
use Internships\Exceptions\Path\CouldNotReadPathException;
use Internships\Exceptions\Path\IsNotDirectoryPathException;
use Internships\Exceptions\Path\NotFoundPathException;
use Internships\Helpers\OutputParser;
use Internships\Services\UniquePathGuard;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class FileManager
{
    protected int $jsonPrintFlags = JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES;

    public function __construct(
        protected DirectoryManager $directoryManager,
        protected UniquePathGuard $pathGuard,
    ) {}

    public function getDefaultJsonFlags(): int
    {
        return $this->jsonPrintFlags;
    }

    public function create(
        RelativePathIdentity $relativePathIdentity,
        mixed $content = "",
        bool $toResource = false,
    ): void {
        $fullPathIdentity = $this->directoryManager->getFullPathIdentity($relativePathIdentity, $toResource);
        if ($relativePathIdentity->getDestinationName() === "") {
            throw new NoNameFileException($fullPathIdentity->getFullDestinationPath());
        }
        $fullDestinationFilePath = $fullPathIdentity->getFullDestinationFilePath();

        $this->pathGuard->verifyIfUnique($fullDestinationFilePath);
        file_put_contents(
            filename: $fullDestinationFilePath,
            data: $content,
        );
    }

    public function appendNewLine(RelativePathIdentity $relativePathIdentity, string $content = "", bool $toResource = false): void
    {
        $fullPathIdentity = $this->directoryManager->getFullPathIdentity($relativePathIdentity, $toResource);
        if ($relativePathIdentity->getDestinationName() === "") {
            throw new NoNameFileException($fullPathIdentity->getFullDestinationPath());
        }
        $fullDestinationFilePath = $fullPathIdentity->getFullDestinationFilePath();

        file_put_contents(
            filename: $fullDestinationFilePath,
            data: OutputParser::endLine($content),
            flags: FILE_APPEND,
        );
    }

    public function copyResource(
        RelativePathIdentity $relativePathIdentity,
        bool $overwrite = true,
        bool $toResource = false,
    ): void {
        $fullPathIdentity = $this->directoryManager->getFullPathIdentity($relativePathIdentity, $toResource);
        $fullSourceFilePath = $fullPathIdentity->getFullSourceFilePath();
        $fullDestinationFilePath = $fullPathIdentity->getFullDestinationFilePath();

        if (!$overwrite && file_exists($fullDestinationFilePath)) {
            throw new AlreadyExistsPathException($fullDestinationFilePath);
        }
        if (!file_exists($fullSourceFilePath)) {
            throw new NotFoundPathException($fullSourceFilePath);
        }
        if (!copy($fullSourceFilePath, $fullDestinationFilePath)) {
            throw new CouldNotReadPathException("{$fullSourceFilePath} and/or {$fullDestinationFilePath}");
        }
    }

    public function copyResources(
        array $fileIdentities,
        RelativePathIdentity $parent,
        bool $overwrite = false,
        bool $toResource = true,
    ): void {
        foreach ($fileIdentities as $filePath) {
            $filePath->setParentIdentity($parent);
            try {
                $this->copyResource($filePath, $overwrite, $toResource);
            } catch (AlreadyExistsPathException $exception) {
                ConsoleWriter::print($exception->getNoStyleMessage(), printNewLine: false);
                ConsoleWriter::warn("Skipping.");
            }
        }
    }

    /**
     * @return array<RelativePathIdentity>
     */
    public function getResourceFilePathsFrom(
        string $relativeOrigin,
        string $specificFileName = "",
    ): array {
        $partialPathIdentity = new RelativePathIdentity(relativeChangingPath: $relativeOrigin);
        $fullPathIdentity = $this->directoryManager->getFullPathIdentity($partialPathIdentity, true);
        $origin = $fullPathIdentity->getFullSourcePath();

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
                if (isset($file->getPath()[0])) {
                    if ($specificFileName === "" || $specificFileName === $file->getFilename()) {
                        $relativePath = substr($file->getPath(), strlen($origin));
                        $pathIdentity = new RelativePathIdentity(
                            sourceName: $file->getFilename(),
                            relativeChangingPath: $relativePath,
                        );
                        array_push($filePaths, $pathIdentity);
                    }
                }
            }
        }
        return $filePaths;
    }
}
