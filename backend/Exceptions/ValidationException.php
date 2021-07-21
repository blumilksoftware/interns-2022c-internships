<?php


namespace Internships\Exceptions;


use Exception;
use Throwable;

class ValidationException extends Exception
{
    public const DEFAULT = 0;
    public const NOT_AN_ARRAY = 1;
    public const IS_EMPTY = 2;
    public const IS_EMPTY_AFTER_SANITIZE = 3;
    public const REQUIRED_MISSING = 4;
    public const INVALID_COUNT = 5;

    protected int $entryID;
    protected string $fieldName;

    public function __construct(int $entryID, string $fieldName, $code = self::DEFAULT, Throwable $previous = null)
    {
        $this->entryID = $entryID;
        $this->fieldName = $fieldName;
        $message = $this->getMessageFromCode($code);
        parent::__construct($message, $code, $previous);
    }

    function getMessageFromCode($code) : string{
        switch($code){
            case self::NOT_AN_ARRAY:
                return "Field {$this->fieldName} in entry ID:{$this->entryID} is not an array.";
            DEFAULT:
                return "There was trouble validating {$this->fieldName} field in ID:{$this->entryID}";
        }
    }
}
