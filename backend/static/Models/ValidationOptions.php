<?php

declare(strict_types=1);

namespace InternshipsStatic\Models;

class ValidationOptions
{
    public function __construct(
        protected bool $required = false,
        protected int $sanitizationFlags = SANITIZE_WHITESPACE_TRIM,
        protected string $arraySeparator = "",
        protected int $minArrayCount = 0,
        protected int $maxArrayCount = 0,
        protected int $expectedArrayCount = -1,
        protected int $maxDecimals = -1,
    ) {}

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function getFlags(): int
    {
        return $this->sanitizationFlags;
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
