<?php

declare(strict_types=1);

namespace Internships\Exceptions\File;

use Internships\Exceptions\SimpleMessageException;
use Throwable;

class FileException extends SimpleMessageException
{
    public function __construct(
        protected string $fullPath,
        int $code = 0,
        ?Throwable $previous = null,
    ) {
        parent::__construct($code, $previous);
    }

    protected function newExceptionMessage(): string
    {
        return "There was trouble processing file at {$this->fullPath}. Does it have necessary permissions?";
    }

    protected function getStatusCode(): int
    {
        return static::UNPROCESSABLE_ENTITY;
    }
}
