<?php

declare(strict_types=1);

namespace Internships\Exceptions\Path;

use Internships\Exceptions\SimpleMessageException;
use Throwable;

class PathException extends SimpleMessageException
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
        return "There was trouble processing path {$this->fullPath}.";
    }

    protected function getStatusCode(): int
    {
        return static::UNPROCESSABLE_ENTITY;
    }
}
