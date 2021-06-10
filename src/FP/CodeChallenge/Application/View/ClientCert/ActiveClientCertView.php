<?php

namespace App\Application\View\ClientCert;

use App\Application\Request\View\ClientCert\ActiveClientCertRequest;
use App\Application\View\ViewInterface;
use App\Domain\Model\Repository\ClientCertRepositoryInterface;
use App\Application\Transformer\ClientCertTransformer;

class ActiveClientCertView implements ViewInterface
{
    private $clientCertRepository;

    public function __construct(ClientCertRepositoryInterface $clientCertRepository)
    {
        $this->clientCertRepository = $clientCertRepository;
    }

    public function execute($request = null)
    {
        if (!$request instanceof ActiveClientCertRequest) {
            throw new \InvalidArgumentException('The request must be ActiveClientCertRequest instance');
        }
        
        $serialNumber = $request->serialNumber();
        
        $clientCert = $this->clientCertRepository->findBySerialNumber($serialNumber);

        if (empty($clientCert)) {
            return null;
        }

        $clientCertDTO = new ClientCertTransformer($clientCert);

        return $clientCertDTO;
    }
}