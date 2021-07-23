<?php

declare(strict_types=1);

namespace Internships\Exceptions\Validation;

class NotAnArrayValidationException extends ValidationException
{
    protected function newExceptionMessage(): string
    {
        return "Field {$this->fieldName} in entry ID:{$this->entryID} is not an array.";
    }

    protected function getStatusCode(): int
    {
        return static::IM_A_TEAPOT;
    }
}
