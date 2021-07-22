<?php

declare(strict_types=1);

namespace Internships\Exceptions\File;

use Throwable;

class CsvInvalidCountFileException extends FileException
{
    protected int $lineNumber;
    protected int $expectedCount;
    protected int $receivedCount;

    public function __construct(
        string $fullPath,
        int $lineNumber,
        int $expectedCount,
        int $receivedCount,
        int $code = 0,
        Throwable $previous = null
    ) {
        $this->lineNumber = $lineNumber;
        $this->expectedCount = $expectedCount;
        $this->receivedCount = $receivedCount;
        parent::__construct(
            $fullPath,
            $code,
            $previous
        );
    }

    protected function newExceptionMessage(): string
    {
        return "Csv file at {$this->fullPath} has invalid number of fields on line {$this->lineNumber}. 
        Expected {$this->expectedCount}. Got {$this->receivedCount}.";
    }
}
