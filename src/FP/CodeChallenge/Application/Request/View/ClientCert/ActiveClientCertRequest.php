<?php

namespace App\Application\Request\View\ClientCert;

use App\Domain\ValueObject\SerialNumber;

class ActiveClientCertRequest
{
    private $serialNumber;

    public function __construct(SerialNumber $serialNumber)
    {
        $this->serialNumber = $serialNumber;
    }

    public function serialNumber()
    {
        return $this->serialNumber;
    }
}