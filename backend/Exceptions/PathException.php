<?php


namespace Internships\Exceptions;


use Exception;
use Throwable;

class PathException extends Exception
{
    protected string $fullPath;
    public function __construct(string $fullPath, int $code = 0, Throwable $previous = null)
    {
        $this->fullPath = $fullPath;
        $message = $this->newExceptionMessage();
        parent::__construct($message, $code, $previous);
    }
    protected function newExceptionMessage(): string
    {
        return "There was trouble processing path {$this->fullPath}.";
    }
}