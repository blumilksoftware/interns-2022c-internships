<?php

declare(strict_types=1);

namespace Internships\CommandLine;

class ColorCode
{
    public const TEXT_BLACK = "30";
    public const TEXT_WHITE = "1;37";

    public const BACKGROUND_NONE = "";
    public const BACKGROUND_RED = "41;";
    public const BACKGROUND_GREEN = "42;";
    public const BACKGROUND_YELLOW = "43;";
    public const BACKGROUND_BLUE = "46;";

    public static function get(
        string $textColor = self::TEXT_WHITE,
        string $backgroundColor = self::BACKGROUND_NONE
    ): string {
        return $backgroundColor
            . $textColor;
    }
}
