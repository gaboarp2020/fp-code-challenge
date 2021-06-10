<?php

namespace App\Domain\Model;

use App\Domain\ValueObject\SerialNumber;

class ClientCert
{
    private $id;
    private $commonName;
    private $serialNumber;
    private $createdAt;

    public function __construct(string $commonName,SerialNumber $serialNumber)
    {
        $this->commonName = $commonName;
        $this->serialNumber = $serialNumber->value();
        $this->createdAt = new \DateTime();
    }

    public static function build(string $commonName,SerialNumber $serialNumber): self 
    {
        
        $clientCert = new static($commonName, $serialNumber);

        return $clientCert;
    }

    public function id()
    {
        return $this->id;
    }
    public function commonName()
    {
        return $this->commonName;
    }
    public function serialNumber()
    {
        return $this->serialNumber;
    }
    public function createdAt()
    {
        return $this->createdAt;
    }
     /**
     * Determines if the browser provided a valid SSL client certificate
     *
     * @return boolean True if the client cert is there and is valid
     */
    public static function isValid(array $clientCertData)
    {
        if (array_key_exists ('CN', $clientCertData)) {
            $status = $clientCertData['status'];
            $ssl_cert_cn = $clientCertData['CN'];
            $ssl_cert_sn = $clientCertData['SN'];
        }

        if (!isset($status) || !($status === 'SUCCESS')) {
            return false;
        }

        if (!isset($ssl_cert_cn) || !isset($ssl_cert_sn)) 
        {
            return false;
        }

        return true;
    }
     /**
     * Gets the current client certificate data
     *
     * @return array
     */
    public static function getData()
    {
        $clientCertData = [];

        if (array_key_exists ('SSL_CLIENT_S_DN_CN', $_SERVER)) {
            $clientCertData['status'] = $_SERVER['SSL_CLIENT_VERIFY']; 
            $clientCertData['CN'] = $_SERVER ['SSL_CLIENT_S_DN_CN']; 
            $clientCertData['SN'] = $_SERVER ['SSL_CLIENT_M_SERIAL']; 
        }

        return $clientCertData;
    }
}