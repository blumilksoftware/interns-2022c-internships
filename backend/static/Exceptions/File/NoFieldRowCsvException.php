<?php

declare(strict_types=1);

namespace InternshipsStatic\Exceptions\File;

class NoFieldRowCsvException extends FileException
{
    protected function newExceptionMessage(): string
    {
        return "File {$this->fullPath} has no required row for fields.";
    }

    protected function getStatusCode(): int
    {
        return static::BAD_REQUEST;
    }
}
