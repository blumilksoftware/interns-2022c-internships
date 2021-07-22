<?php


namespace Internships\Exceptions;


class NotFoundPathException extends PathException
{
    protected function newExceptionMessage(): string
    {
        return "Element at path {$this->fullPath} not found.";
    }
}