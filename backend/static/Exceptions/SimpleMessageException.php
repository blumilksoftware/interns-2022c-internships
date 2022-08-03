<?php

declare(strict_types=1);

namespace InternshipsStatic\Exceptions;

use Exception;
use InternshipsStatic\CommandLine\ColorText;
use InternshipsStatic\Helpers\OutputParser;
use Throwable;

class SimpleMessageException extends Exception
{
    use OutputParser;

    protected const BAD_REQUEST = 400;
    protected const METHOD_NOT_ALLOWED = 405;
    protected const FORBIDDEN = 403;
    protected const NOT_FOUND = 404;
    protected const RANGE_NOT_SATISFIABLE = 416;
    protected const IM_A_TEAPOT = 418;
    protected const UNPROCESSABLE_ENTITY = 422;

    protected string $noStyleMessage;

    public function __construct(int $code = 0, ?Throwable $previous = null)
    {
        $this->noStyleMessage = $this->newExceptionMessage();
        $message = static::separateLine(
            ColorText::colorize(
                escapeColor: ColorText::getEscapedColor(
                    textColor: ColorText::TEXT_BLACK,
                    backgroundColor: ColorText::BACKGROUND_RED,
                ),
                message: $this->noStyleMessage,
            ) . " SimpleMessageException.php",
        );
        parent::__construct($message, $this->getStatusCode(), $previous);
    }

    public function getNoStyleMessage(): mixed
    {
        return $this->noStyleMessage . " ";
    }

    protected function newExceptionMessage(): string
    {
        throw new Exception("Exception definition is invalid. ", static::METHOD_NOT_ALLOWED);
    }

    protected function getStatusCode(): int
    {
        return static::METHOD_NOT_ALLOWED;
    }
}
