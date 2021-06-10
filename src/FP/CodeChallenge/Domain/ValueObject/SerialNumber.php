<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidSerialNumberException;

class SerialNumber 
{
    private $value;

    public function __construct(string $serialNumber)
    {
        $this->value = $serialNumber;
    }

    public static function build(string $value): self
    {
        try {
            $serialNumber = new self($value);
        } catch (InvalidSerialNumberException $exception) {
            throw InvalidSerialNumberException::build();
        }
        return $serialNumber;
    }

    public function value() {
        return $this->value;
    }
}