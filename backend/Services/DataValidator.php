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

            $minArrayCount = $fieldValidationOptions->getMinArrayCount();
            $maxArrayCount = $fieldValidationOptions->getMaxArrayCount();
            if ($minArrayCount > 0 || $maxArrayCount > 0) {
                if (!is_array($sanitizedVal)) {
                    throw new NotAnArrayValidationException($entryID, $fieldName);
                }

                $elementCount = count($sanitizedVal);
                if ($elementCount < $minArrayCount
                    || ($elementCount > $maxArrayCount && $maxArrayCount > 0)) {
                    throw new InvalidCountValidationException(
                        $entryID,
                        $fieldName,
                        $minArrayCount,
                        $maxArrayCount,
                        $elementCount
                    );
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
