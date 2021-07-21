<?php

declare(strict_types=1);

namespace Internships\Helpers;

class OutputWriter
{
    public static function newLine(string $text = ""): string
    {
        return $text . PHP_EOL;
    }

    public static function newLineToConsole(string $text = ""): void
    {
        echo static::newLine($text);
    }
}
