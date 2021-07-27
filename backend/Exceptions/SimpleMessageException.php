<?php

declare(strict_types=1);

namespace Internships\Exceptions;

use ECSPrefix20210517\Nette\NotImplementedException;
use Exception;
use Throwable;

class SimpleMessageException extends Exception
{
    protected const BAD_REQUEST = 400;
    protected const METHOD_NOT_ALLOWED = 405;
    protected const FORBIDDEN = 403;
    protected const NOT_FOUND = 404;
    protected const RANGE_NOT_SATISFIABLE = 416;
    protected const IM_A_TEAPOT = 418;
    protected const UNPROCESSABLE_ENTITY = 422;

    public function __construct(int $code = 0, Throwable $previous = null)
    {
        $message = $this->newExceptionMessage();
        parent::__construct($message, $this->getStatusCode(), $previous);
    }

    protected function newExceptionMessage(): string
    {
        throw new NotImplementedException("Exception definition is invalid.", static::METHOD_NOT_ALLOWED);
    }

    protected function getStatusCode(): int
    {
        return static::METHOD_NOT_ALLOWED;
    }
}
