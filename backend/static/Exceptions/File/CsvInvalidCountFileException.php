<?php

declare(strict_types=1);

namespace InternshipsStatic\Exceptions\File;

use Throwable;

class CsvInvalidCountFileException extends FileException
{
    public function __construct(
        string $fullPath,
        protected int $lineNumber,
        protected int $expectedCount,
        protected int $receivedCount,
        int $code = 0,
        ?Throwable $previous = null,
    ) {
        parent::__construct(
            $fullPath,
            $code,
            $previous,
        );
    }

    protected function newExceptionMessage(): string
    {
        return "Csv file at {$this->fullPath} has invalid number of fields on line {$this->lineNumber}. 
        Expected {$this->expectedCount}. Got {$this->receivedCount}.";
    }

    protected function getStatusCode(): int
    {
        return static::RANGE_NOT_SATISFIABLE;
    }
}
