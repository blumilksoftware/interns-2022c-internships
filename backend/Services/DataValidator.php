<?php


namespace Internships\Services;


use Exception;

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
        bool $required = false,
        int $sanitizationFlags = SANITIZE_WHITESPACE_TRIM,
        string $arraySeparator = null,
        int $maxDecimals = null,
        int $expectedCount = null,
    ): mixed {
        if (!($fieldValue === null || $fieldValue === "")) {
            $sanitizedVal = $this->sanitizer->sanitize(
                $fieldValue,
                $sanitizationFlags,
                $arraySeparator,
                $maxDecimals
            );
            if ($required && ($fieldValue === null || $fieldValue === "")){
                throw new Exception("Required field " . $fieldName . " in ID:" . $entryID
                                    . "is empty after sanitization.");
            }
            if(!is_null($expectedCount)){
                if(!is_array($sanitizedVal)){
                    throw new Exception("Field " . $fieldName . " in ID:" . $entryID
                                        . "is not an array.");
                }
                $count = count($sanitizedVal);
                if($count != $expectedCount){
                    throw new Exception("Field " . $fieldName . " in ID:" . $entryID
                                        . " has invalid number of elements: " . $count
                                        . ". Expected " . $expectedCount . ".");
                }
            }
            return $sanitizedVal;
        }
        else if ($required) {
            throw new Exception("Required field " . $fieldName . " in ID:" . $entryID . "is missing.");
        }

        if ($arraySeparator !== null) {
            return [];
        }
        return "";
    }
}