<?php

declare(strict_types=1);

namespace Internships\Interfaces;


interface CommandLineCallable
{
    public function getName(): string;

     /** @return string[] */
    public function getAllowedEnvironment(): array;

    public function isAllowed(): bool;

    public function getFailMessage(): string;

    public function getDescription(): string;

    public function getExtendedDescription(): string;
}
