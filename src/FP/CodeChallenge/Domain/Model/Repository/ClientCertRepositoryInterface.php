<?php

namespace App\Domain\Model\Repository;

use App\Domain\Model\ClientCert;
use App\Domain\ValueObject\SerialNumber;

interface ClientCertRepositoryInterface {
    public function add(ClientCert $clientCert): void;
    public function findBySerialNumber(SerialNumber $serialNumber): ?ClientCert;
    public function delete(ClientCert $clientCert): void;
}