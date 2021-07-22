<?php

declare(strict_types=1);

namespace Internships\Exceptions\File;

class NoNameFileException extends FileException
{
    protected function newExceptionMessage(): string
    {
        return "Issue at {$this->fullPath}. No file name.";
    }

    protected function getStatusCode(): int
    {
        return static::BAD_REQUEST;
    }
}
