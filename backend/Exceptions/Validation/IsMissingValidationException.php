<?php

declare(strict_types=1);

namespace Internships\Exceptions\Validation;

class IsMissingValidationException extends ValidationException
{
    protected function newExceptionMessage(): string
    {
        return "Required field {$this->fieldName} in ID:{$this->entryID} is missing.";
    }
}
