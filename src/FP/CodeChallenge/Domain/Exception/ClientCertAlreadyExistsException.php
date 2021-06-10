<?php

namespace App\Domain\Exception;

use Exception;
use Throwable;

class ClientCertAlreadyExistsException extends Exception
{
    public const INVALID_SN_MESSAGE = 'The Client Certificate already exists';

    public static function build(string $message = self::INVALID_SN_MESSAGE, int $code = 0, Throwable $previous = null): ClientCertAlreadyExistsException
    {
        return new static($message, $code, $previous);
    }
}
