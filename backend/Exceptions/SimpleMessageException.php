<?php

declare(strict_types=1);

namespace Internships\Exceptions;

use ECSPrefix20210517\Nette\NotImplementedException;
use Exception;
use Throwable;

class SimpleMessageException extends Exception
{
    protected function __construct(int $code = 0, Throwable $previous = null)
    {
        $message = $this->newExceptionMessage();
        parent::__construct($message, $code, $previous);
    }

    protected function newExceptionMessage(): string
    {
        throw new NotImplementedException();
    }
}
