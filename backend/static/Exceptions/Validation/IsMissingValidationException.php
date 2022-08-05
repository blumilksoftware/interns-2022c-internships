<?php

declare(strict_types=1);

namespace InternshipsStatic\Exceptions\Validation;

class IsMissingValidationException extends ValidationException
{
    protected function newExceptionMessage(): string
    {
        return "Required field {$this->fieldName} in ID:{$this->entryId} is missing.";
    }

    protected function getStatusCode(): int
    {
        return static::BAD_REQUEST;
    }
}
