<?php

declare(strict_types=1);

namespace Internships\Exceptions\Path;

class AlreadyExistsPathException extends PathException
{
    protected function newExceptionMessage(): string
    {
        return "{$this->fullPath} already exists.";
    }
}
