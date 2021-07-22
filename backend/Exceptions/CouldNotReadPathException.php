<?php


namespace Internships\Exceptions;


class CouldNotReadPathException extends PathException
{
    protected function newExceptionMessage(): string
    {
        return "{$this->fullPath} cannot be read.";
    }
}