<?php

declare(strict_types=1);

namespace Internships\Exceptions\Path;

class IsNotDirectoryPathException extends PathException
{
    protected function newExceptionMessage(): string
    {
        return "Element at path {$this->fullPath} is not a directory.";
    }

    protected function getStatusCode(): int
    {
        return static::BAD_REQUEST;
    }
}
