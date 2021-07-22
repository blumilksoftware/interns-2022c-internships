<?php

declare(strict_types=1);

namespace Internships\Exceptions\Validation;

use Throwable;

class InvalidCountValidationException extends ValidationException
{
    protected int $expectedCount;
    protected $receivedCount;

    public function __construct(
        int $entryID,
        string $fieldName,
        int $expectedCount,
        int $receivedCount,
        int $code = 0,
        Throwable $previous = null
    ) {
        $this->expectedCount = $expectedCount;
        $this->receivedCount = $receivedCount;
        parent::__construct(
            $entryID,
            $fieldName,
            $code,
            $previous
        );
    }

    protected function newExceptionMessage(): string
    {
        return "Field {$this->fieldName} in ID:{$this->entryID} has invalid number of elements: {$this->receivedCount}.
                       Expected {$this->expectedCount}.";
    }

    protected function getStatusCode(): int
    {
        return static::RANGE_NOT_SATISFIABLE;
    }
}
