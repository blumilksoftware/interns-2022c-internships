<?php

declare(strict_types=1);

namespace Internships\Exceptions\Path;

class NotUniquePathException extends PathException
{
    protected function newExceptionMessage(): string
    {
        return "Path {$this->fullPath} is not unique.";
    }

    protected function getStatusCode(): int
    {
        return static::FORBIDDEN;
    }
}
