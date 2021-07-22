<?php

declare(strict_types=1);

namespace Internships\Exceptions\Path;

use Internships\Exceptions\SimpleMessageException;
use Throwable;

class PathException extends SimpleMessageException
{
    protected string $fullPath;

    public function __construct(string $fullPath, int $code = 0, Throwable $previous = null)
    {
        $this->fullPath = $fullPath;
        parent::__construct($code, $previous);
    }

    protected function newExceptionMessage(): string
    {
        return "There was trouble processing path {$this->fullPath}.";
    }
}
