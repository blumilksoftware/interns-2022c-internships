<?php

declare(strict_types=1);

namespace Internships\Exceptions\Path;

class NotFoundPathException extends PathException
{
    protected function newExceptionMessage(): string
    {
        return "Element at path {$this->fullPath} not found.";
    }
}
