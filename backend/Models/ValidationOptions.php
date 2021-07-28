<?php

declare(strict_types=1);

namespace Internships\Models;

class ValidationOptions
{
    protected bool $required;
    protected int $flags;
    protected string $arraySeparator;
    protected int $minArrayCount;
    protected int $maxArrayCount;
    protected int $maxDecimals;
    protected int $expectedArrayCount;

    public function __construct(
        bool $required = false,
        int $sanitizationFlags = SANITIZE_WHITESPACE_TRIM,
        string $arraySeparator = "",
        int $minArrayCount = 0,
        int $maxArrayCount = 0,
        int $expectedArrayCount = -1,
        int $maxDecimals = -1
    ) {
        $this->required = $required;
        $this->flags = $sanitizationFlags;
        $this->arraySeparator = $arraySeparator;
        $this->maxDecimals = $maxDecimals;
        $this->minArrayCount = $minArrayCount;
        $this->maxArrayCount = $maxArrayCount;
        $this->expectedArrayCount = $expectedArrayCount;
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

    public function getMinArrayCount(): int
    {
        return $this->minArrayCount;
    }

    public function getMaxArrayCount(): int
    {
        return $this->maxArrayCount;
    }

    public function getExpectedArrayCount(): int
    {
        return $this->expectedArrayCount;
    }
}
