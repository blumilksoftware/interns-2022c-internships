<?php

declare(strict_types=1);

namespace Internships\Helpers;

trait OutputParser
{
    protected static function endLine(string $text = ""): string
    {
        return $text . PHP_EOL;
    }

    protected static function separateLine(string $text = ""): string
    {
        return PHP_EOL . $text . PHP_EOL;
    }

    protected static function startLine(string $text = ""): string
    {
        return PHP_EOL . $text;
    }

    protected static function colorize(string $colorCode, string $message): string
    {
        return "\033[{$colorCode}m" . $message . "\033[0m";
    }
}
