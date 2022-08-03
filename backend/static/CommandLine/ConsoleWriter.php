<?php

declare(strict_types=1);

namespace InternshipsStatic\CommandLine;

use InternshipsStatic\Helpers\OutputParser;

class ConsoleWriter
{
    use OutputParser;

    public static function print(string $message = "", bool $printNewLine = true): void
    {
        if ($printNewLine) {
            echo static::endLine($message);
        } else {
            echo $message;
        }
    }

    public static function error(string $message = "", bool $newLine = true): void
    {
        static::print(
            ColorText::colorize(
                escapeColor: ColorText::getEscapedColor(
                    textColor: ColorText::TEXT_BLACK,
                    backgroundColor: ColorText::BACKGROUND_RED,
                ),
                message: $message,
            ),
            printNewLine: $newLine,
        );
    }

    public static function info(string $message = "", bool $newLine = true): void
    {
        static::print(
            ColorText::colorize(
                escapeColor: ColorText::getEscapedColor(
                    textColor: ColorText::TEXT_BLACK,
                    backgroundColor: ColorText::BACKGROUND_BLUE,
                ),
                message: $message,
            ),
            printNewLine: $newLine,
        );
    }

    public static function warn(string $message = "", bool $newLine = true): void
    {
        static::print(
            ColorText::colorize(
                escapeColor: ColorText::getEscapedColor(backgroundColor: ColorText::BACKGROUND_YELLOW),
                message: $message,
            ),
            printNewLine: $newLine,
        );
    }

    public static function success(string $message = "", bool $newLine = true): void
    {
        static::print(
            ColorText::colorize(
                escapeColor: ColorText::getEscapedColor(
                    textColor: ColorText::TEXT_BLACK,
                    backgroundColor: ColorText::BACKGROUND_GREEN,
                ),
                message: $message,
            ),
            printNewLine: $newLine,
        );
    }
}
