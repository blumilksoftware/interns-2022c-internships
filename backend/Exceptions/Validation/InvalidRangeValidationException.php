<?php

declare(strict_types=1);

namespace Internships\Exceptions\Validation;

use Throwable;

class InvalidRangeValidationException extends ValidationException
{
    public function __construct(
        int $entryId,
        string $fieldName,
        protected int $minCount,
        protected int $maxCount,
        protected int $receivedCount,
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct(
            $entryId,
            $fieldName,
            $code,
            $previous
        );
    }

    protected function newExceptionMessage(): string
    {
        return "Field {$this->fieldName} in ID:{$this->entryId} has invalid number of elements: {$this->receivedCount}."
                       . " Expected range from {$this->minCount} to {$this->maxCount}";
    }

    protected function getStatusCode(): int
    {
        return static::RANGE_NOT_SATISFIABLE;
    }
}
