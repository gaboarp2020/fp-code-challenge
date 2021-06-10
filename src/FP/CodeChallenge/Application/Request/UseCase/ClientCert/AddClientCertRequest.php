<?php

namespace App\Application\Request\UseCase\ClientCert;

use App\Domain\ValueObject\SerialNumber;

class AddClientCertRequest
{
    private $commonName;
    private $serialNumber;
    private $status;

    public function __construct(string $commonName, SerialNumber $serialNumber, string $status)
    {
        $this->commonName = $commonName;
        $this->serialNumber = $serialNumber;
        $this->status = $status;
    }

    public static function buildFromArray(array $clientCertData): self
    {
        return new self($clientCertData['CN'],SerialNumber::build($clientCertData['SN']), $clientCertData['status']);
    }
    
    public function commonName()
    {
        return $this->commonName;
    }

    public function serialNumber()
    {
        return $this->serialNumber;
    }

    public function status()
    {
        return $this->status;
    }
}