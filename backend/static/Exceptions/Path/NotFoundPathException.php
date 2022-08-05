<?php

declare(strict_types=1);

namespace InternshipsStatic\Exceptions\Path;

class NotFoundPathException extends PathException
{
    protected function newExceptionMessage(): string
    {
        return "Element at path {$this->fullPath} not found.";
    }

    protected function getStatusCode(): int
    {
        return static::NOT_FOUND;
    }
}
