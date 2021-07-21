<?php

declare(strict_types=1);

namespace Internships\Services;

use Exception;
use Internships\Models\ValidationOptions;

class DataValidator
{
    public function __construct(
        protected DataSanitizer $sanitizer
    ) {
    }

    public function validateField(
        string $fieldValue,
        int $entryID,
        string $fieldName,
        ValidationOptions $fieldValidationOptions
    ): mixed {
        if ($fieldValidationOptions === null) {
            return $fieldValue;
        }

        if (!($fieldValue === null || $fieldValue === "")) {
            $sanitizedVal = $this->sanitizer->sanitize(
                $fieldValue,
                $fieldValidationOptions->getFlags(),
                $fieldValidationOptions->getArraySeparator(),
                $fieldValidationOptions->getMaxDecimals()
            );
            if ($fieldValidationOptions->isRequired() && ($fieldValue === null || $fieldValue === "")) {
                throw new Exception(
                    "Required field {$fieldName} in entry ID:{$entryID} is empty after sanitization."
                );
            }
            $expectedCount = $fieldValidationOptions->getExpectedCount();
            if ($expectedCount >= 0) {
                if (!is_array($sanitizedVal)) {
                    throw new Exception(
                        "Field {$fieldName} in entry ID:{$entryID} is not an array."
                    );
                }
                $elementCount = count($sanitizedVal);
                if ($elementCount !== $expectedCount) {
                    throw new Exception(
                        "Field {$fieldName} in ID:{$entryID} has invalid number of elements: {$elementCount}.
                        Expected {$expectedCount}."
                    );
                }
            }
            return $sanitizedVal;
        } elseif ($fieldValidationOptions->isRequired()) {
            throw new Exception("Required field {$fieldName} in ID:{$entryID} is missing.");
        }

        if ($fieldValidationOptions->getArraySeparator() !== "") {
            return [];
        }
        return "";
    }
}
