<?php

declare(strict_types=1);

namespace Internships\Interfaces;

interface SerializableInfo
{
    public function getSourceRelativePath(): string;

    public function getSourceFileName(): string;

    public function getSourceFilePath(): string;

    public function getDestinationRelativePath(): string;

    public function getDestinationFileName(): string;

    public function getDestinationFilePath(): string;
}
