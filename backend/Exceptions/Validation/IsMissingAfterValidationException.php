<?php

declare(strict_types=1);

namespace Internships\Exceptions\Validation;

class IsMissingAfterValidationException extends ValidationException
{
    protected function newExceptionMessage(): string
    {
        return "Required field {$this->fieldName} in entry ID:{$this->entryID} is empty after sanitization.";
    }
}
