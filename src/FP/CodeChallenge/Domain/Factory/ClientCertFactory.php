<?php

namespace App\Domain\Factory;

use App\Domain\Model\ClientCert;

class clientCertFactory
{
    public function add(ClientCert $clientCert) {
        return $clientCert;
    }
}