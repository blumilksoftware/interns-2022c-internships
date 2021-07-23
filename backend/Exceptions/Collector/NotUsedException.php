<?php

declare(strict_types=1);

namespace Internships\Exceptions\Collector;

use Internships\Exceptions\SimpleMessageException;

class NotUsedException extends SimpleMessageException
{
    protected function newExceptionMessage(): string
    {
        return "Method not intended to be used in this context";
    }

    protected function getStatusCode(): int
    {
        return static::METHOD_NOT_ALLOWED;
    }
}
