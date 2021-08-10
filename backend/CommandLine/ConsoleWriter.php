<?php

declare(strict_types=1);

namespace Internships\CommandLine;

use Internships\Helpers\OutputParser;

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
            static::colorize(
                colorCode: ColorCode::get(
                    textColor: ColorCode::TEXT_BLACK,
                    backgroundColor: ColorCode::BACKGROUND_RED
                ),
                message: $message
            ),
            printNewLine: $newLine
        );
    }

    public static function info(string $message = "", bool $newLine = true): void
    {
        static::print(
            static::colorize(
                colorCode: ColorCode::get(
                    textColor: ColorCode::TEXT_BLACK,
                    backgroundColor: ColorCode::BACKGROUND_BLUE
                ),
                message: $message
            ),
            printNewLine: $newLine
        );
    }

    public static function warn(string $message = "", bool $newLine = true): void
    {
        static::print(
            static::colorize(
                colorCode: ColorCode::get(backgroundColor: ColorCode::BACKGROUND_YELLOW),
                message: $message
            ),
            printNewLine: $newLine
        );
    }

    public static function success(string $message = "", bool $newLine = true): void
    {
        static::print(
            static::colorize(
                colorCode: ColorCode::get(
                    textColor: ColorCode::TEXT_BLACK,
                    backgroundColor: ColorCode::BACKGROUND_GREEN
                ),
                message: $message
            ),
            printNewLine: $newLine
        );
    }
}
