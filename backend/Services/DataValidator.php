<?php

declare(strict_types=1);

namespace Internships\Services;

use Internships\Exceptions\Validation\InvalidCountValidationException;
use Internships\Exceptions\Validation\IsMissingAfterValidationException;
use Internships\Exceptions\Validation\IsMissingValidationException;
use Internships\Exceptions\Validation\NotAnArrayValidationException;
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
                throw new IsMissingAfterValidationException($entryID, $fieldName);
            }
            $expectedCount = $fieldValidationOptions->getExpectedCount();
            if ($expectedCount >= 0) {
                if (!is_array($sanitizedVal)) {
                    throw new NotAnArrayValidationException($entryID, $fieldName);
                }
                $elementCount = count($sanitizedVal);
                if ($elementCount !== $expectedCount) {
                    throw new InvalidCountValidationException($entryID, $fieldName, $expectedCount, $elementCount);
                }
            }
            return $sanitizedVal;
        } elseif ($fieldValidationOptions->isRequired()) {
            throw new IsMissingValidationException($entryID, $fieldName);
        }

        if ($fieldValidationOptions->getArraySeparator() !== "") {
            return [];
        }
        return "";
    }
}
