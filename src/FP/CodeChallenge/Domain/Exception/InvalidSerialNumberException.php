<?php

namespace App\Domain\Exception;

use Exception;
use Throwable;

class InvalidSerialNumberException extends Exception
{
    public const INVALID_SN_MESSAGE = 'The Serial Number is invalid';

    public static function build(string $message = self::INVALID_SN_MESSAGE, int $code = 0, Throwable $previous = null): InvalidSerialNumberException
    {
        return new static($message, $code, $previous);
    }
}
