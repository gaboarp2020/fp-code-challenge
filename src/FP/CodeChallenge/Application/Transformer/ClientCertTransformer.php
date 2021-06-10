<?php

namespace App\Application\Transformer;

use App\Domain\Model\ClientCert;

final class ClientCertTransformer
{
    private $id;
    private $commonName;
    private $serialNumber;
    private $createdAt;
    
    public function __construct(ClientCert $clientCert)
    {
        $this->id = $clientCert->id();
        $this->commonName = $clientCert->commonName();
        $this->serialNumber = $clientCert->serialNumber();
        $this->createdAt = $clientCert->createdAt()->format('d-m-y H:i:s');;
    }
    public function id(): string
    {
        return $this->id;
    }
    public function commonName(): string
    {
        return $this->commonName;
    }
    public function serialNumber(): string
    {
        return $this->serialNumber;
    }
    public function createdAt(): string
    {
        return $this->createdAt;
    }
}