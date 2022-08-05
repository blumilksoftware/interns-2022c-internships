<?php

declare(strict_types=1);

namespace InternshipsStatic\Exceptions\Path;

class AlreadyExistsPathException extends PathException
{
    protected function newExceptionMessage(): string
    {
        return "{$this->fullPath} already exists.";
    }

    protected function getStatusCode(): int
    {
        return static::FORBIDDEN;
    }
}
