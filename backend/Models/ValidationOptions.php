<?php

declare(strict_types=1);

namespace Internships\Models;

class ValidationOptions
{
    protected bool $required;
    protected int $flags;
    protected string $arraySeparator;
    protected int $maxDecimals;
    protected int $expectedCount;

    public function __construct(
        bool $required = false,
        int $sanitizationFlags = SANITIZE_WHITESPACE_TRIM,
        string $arraySeparator = "",
        int $maxDecimals = -1,
        int $expectedCount = -1
    ) {
        $this->required = $required;
        $this->flags = $sanitizationFlags;
        $this->arraySeparator = $arraySeparator;
        $this->maxDecimals = $maxDecimals;
        $this->expectedCount = $expectedCount;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function getFlags(): int
    {
        return $this->flags;
    }

    public function getArraySeparator(): string
    {
        return $this->arraySeparator;
    }

    public function getMaxDecimals(): int
    {
        return $this->maxDecimals;
    }

    public function getExpectedCount(): int
    {
        return $this->expectedCount;
    }
}
