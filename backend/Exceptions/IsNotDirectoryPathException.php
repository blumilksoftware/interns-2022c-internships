<?php


namespace Internships\Exceptions;


class IsNotDirectoryPathException extends PathException
{
    protected function newExceptionMessage(): string
    {
        return "Element at path {$this->fullPath} not found.";
    }
}