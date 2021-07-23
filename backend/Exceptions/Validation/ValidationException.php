<?php

declare(strict_types=1);

namespace Internships\Exceptions\Validation;

use Internships\Exceptions\SimpleMessageException;
use Throwable;

class ValidationException extends SimpleMessageException
{
    public function __construct(
        protected int $entryID,
        protected string $fieldName,
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($code, $previous);
    }

    protected function newExceptionMessage(): string
    {
        return "There was trouble validating {$this->fieldName} field in ID:{$this->entryID}";
    }

    protected function getStatusCode(): int
    {
        return static::UNPROCESSABLE_ENTITY;
    }
}
