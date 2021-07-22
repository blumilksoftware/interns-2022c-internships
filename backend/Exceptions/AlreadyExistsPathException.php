<?php


namespace Internships\Exceptions;


class AlreadyExistsPathException  extends PathException
{
    protected function newExceptionMessage(): string
    {
        return "{$this->fullPath} already exists.";
    }
}