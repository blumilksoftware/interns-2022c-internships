<?php

declare(strict_types=1);

namespace InternshipsStatic\Exceptions\Validation;

class IsMissingAfterValidationException extends ValidationException
{
    protected function newExceptionMessage(): string
    {
        return "Required field {$this->fieldName} in entry ID:{$this->entryId} is empty after sanitization.";
    }

    protected function getStatusCode(): int
    {
        return static::BAD_REQUEST;
    }
}
