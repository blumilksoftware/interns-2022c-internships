<?php

declare(strict_types=1);

namespace Internships\Services;

use Exception;
use Internships\Models\ValidationOptions;

class DataValidator
{
    protected DataSanitizer $sanitizer;

    public function __construct()
    {
        $this->sanitizer = new DataSanitizer();
    }

    public function validateField(
        string $fieldValue,
        int $entryID,
        string $fieldName,
        ValidationOptions $fieldSanitizationOptions
    ): mixed {
        if ($fieldSanitizationOptions === null) {
            return $fieldValue;
        }

        if (!($fieldValue === null || $fieldValue === "")) {
            $sanitizedVal = $this->sanitizer->sanitize(
                $fieldValue,
                $fieldSanitizationOptions->getFlags(),
                $fieldSanitizationOptions->getArraySeparator(),
                $fieldSanitizationOptions->getMaxDecimals()
            );
            if ($fieldSanitizationOptions->isRequired() && ($fieldValue === null || $fieldValue === "")) {
                throw new Exception(
                    "Required field " . $fieldName . " in ID:" . $entryID
                    . "is empty after sanitization."
                );
            }
            $expectedCount = $fieldSanitizationOptions->getExpectedCount();
            if ($expectedCount >= 0) {
                if (!is_array($sanitizedVal)) {
                    throw new Exception(
                        "Field " . $fieldName . " in ID:" . $entryID
                        . "is not an array."
                    );
                }
                $count = count($sanitizedVal);
                if ($count !== $expectedCount) {
                    throw new Exception(
                        "Field " . $fieldName . " in ID:" . $entryID
                        . " has invalid number of elements: " . $count
                        . ". Expected " . $expectedCount . "."
                    );
                }
            }
            return $sanitizedVal;
        } elseif ($fieldSanitizationOptions->isRequired()) {
            throw new Exception("Required field " . $fieldName . " in ID:" . $entryID . "is missing.");
        }

        if ($fieldSanitizationOptions->getArraySeparator() !== "") {
            return [];
        }
        return "";
    }
}
