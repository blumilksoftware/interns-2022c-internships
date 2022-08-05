<?php

declare(strict_types=1);

namespace InternshipsStatic\Exceptions\Path;

class CouldNotReadPathException extends PathException
{
    protected function newExceptionMessage(): string
    {
        return "{$this->fullPath} cannot be read.";
    }

    protected function getStatusCode(): int
    {
        return static::FORBIDDEN;
    }
}
