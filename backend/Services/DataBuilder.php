<?php

declare(strict_types=1);

namespace Internships\Services;

use Internships\Interfaces\BuildTool;
use Internships\Interfaces\SerializableInfo;
use Internships\Models\PathPair;

abstract class DataBuilder extends DataSanitizer implements BuildTool, SerializableInfo
{
    public function __construct(
        protected string $temporaryDirectory,
        protected PathPair $source,
        protected PathPair $destination
    ) {
    }

    public function getSourceRelativePath(): string
    {
        return $this->source->getRelativePath()
            . "/"
            . $this->temporaryDirectory;
    }

    public function getSourceFileName(): string
    {
        return $this->source->getFileName();
    }

    public function getSourceFilePath(): string
    {
        return $this->getSourceRelativePath()
            . "/"
            . $this->getSourceFileName();
    }

    public function getDestinationRelativePath(): string
    {
        return $this->destination->getRelativePath()
            . "/"
            . $this->temporaryDirectory;
    }

    public function getDestinationFileName(): string
    {
        return $this->destination->getFileName();
    }

    public function getDestinationFilePath(): string
    {
        return $this->getDestinationRelativePath()
            . "/"
            . $this->getDestinationFileName();
    }

    public function setDirectory(string $directory): void
    {
        $this->temporaryDirectory = $directory;
    }
}
