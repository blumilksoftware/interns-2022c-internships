<?php

declare(strict_types=1);

namespace Internships\Exceptions;

use Exception;
use Throwable;

class ValidationException extends Exception
{
    protected int $entryID;
    protected string $fieldName;

    public function __construct(int $entryID, string $fieldName, int $code = 0, Throwable $previous = null)
    {
        $this->entryID = $entryID;
        $this->fieldName = $fieldName;
        $message = $this->newExceptionMessage();
        parent::__construct($message, $code, $previous);
    }

    protected function newExceptionMessage(): string
    {
        return "There was trouble validating {$this->fieldName} field in ID:{$this->entryID}";
    }
}
