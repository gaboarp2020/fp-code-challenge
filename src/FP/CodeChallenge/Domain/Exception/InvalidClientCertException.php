<?php

namespace App\Domain\Exception;

use Exception;
use Throwable;

class InvalidClientCertException extends Exception
{
    public const INVALID_SN_MESSAGE = 'The Client Cert is invalid';

    public static function build(string $message = self::INVALID_SN_MESSAGE, int $code = 0, Throwable $previous = null): InvalidClientCertException
    {
        return new static($message, $code, $previous);
    }
}
