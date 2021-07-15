<?php

declare(strict_types=1);

namespace Internships\Services;

define("SANITIZE_NONE", (1 << 0));
define("SANITIZE_WHITESPACE_TRIM", (1 << 1));
define("SANITIZE_WHITESPACE_REMOVE", (1 << 2));
define("SANITIZE_WHITESPACE_TO_DASH", (1 << 3));
define("SANITIZE_TO_LOWER", (1 << 4));
define("SANITIZE_TO_UPPER", (1 << 5));
define("SANITIZE_TO_CAPITALIZE_FIRST", (1 << 6));
define("SANITIZE_CAPITALIZE_WORDS", (1 << 7));
define("SANITIZE_NO_ACCENTS", (1 << 8));

class DataSanitizer
{
    public function sanitize(
        string $value,
        int $flags = SANITIZE_WHITESPACE_TRIM,
        string $arraySeparator = "",
        int $maxDecimals = -1
    ): mixed {
        if ($flags & SANITIZE_NO_ACCENTS) {
            $value = normalizer_normalize($value);
        }

        if ($flags & SANITIZE_WHITESPACE_REMOVE) {
            $value = preg_replace("/\s+/", "", $value);
        } else {
            if ($flags & SANITIZE_WHITESPACE_TO_DASH) {
                $value = preg_replace("/\s+/", "-", $value);
            } else {
                if ($flags & SANITIZE_WHITESPACE_TRIM) {
                    $value = trim(preg_replace("/\s+/", " ", $value));
                }
            }
        }

        if ($flags & SANITIZE_TO_LOWER) {
            $value = strtolower($value);
        } else {
            if ($flags & SANITIZE_TO_UPPER) {
                $value = strtoupper($value);
            } else {
                if ($flags & SANITIZE_TO_CAPITALIZE_FIRST) {
                    $value = ucfirst($value);
                } else {
                    if ($flags & SANITIZE_CAPITALIZE_WORDS) {
                        $value = ucwords($value);
                    }
                }
            }
        }

        if ($arraySeparator !== "") {
            $trimmedArray = [];
            foreach (explode($arraySeparator, $value) as $item) {
                if ($maxDecimals >= 0) {
                    $item = preg_replace("/\s+/", "", $item);
                    array_push($trimmedArray, floatval(number_format(floatval($item), $maxDecimals)));
                } else {
                    $item = trim($item);
                    array_push($trimmedArray, $item);
                }
            }
            return $trimmedArray;
        }
        return $value;
    }
}
