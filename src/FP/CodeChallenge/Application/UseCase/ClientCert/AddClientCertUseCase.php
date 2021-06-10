<?php

namespace App\Application\UseCase\ClientCert;

use App\Application\Request\UseCase\ClientCert\AddClientCertRequest;
use App\Application\UseCase\UseCaseInterface;
use App\Domain\Model\ClientCert;
use App\Domain\Model\Repository\ClientCertRepositoryInterface;
use App\Domain\Exception\ClientCertAlreadyExistsException;

class AddClientCertUseCase implements UseCaseInterface
{
    private $clientCertRepository;

    public function __construct(ClientCertRepositoryInterface $clientCertRepository)
    {
        $this->clientCertRepository = $clientCertRepository;
    }

    public function execute($request = null)
    {
        if (!$request instanceof AddClientCertRequest) {
            throw new \InvalidArgumentException('The request must be AddClientCertRequest instance');
        }
        
        $commonName = $request->commonName();
        $serialNumber = $request->serialNumber();
        
        $clientCert = $this->clientCertRepository->findBySerialNumber($serialNumber);
        if ($clientCert instanceof ClientCert) {
            // throw ClientCertAlreadyExistsException::build();
            return null;
        }

        $clientCert = ClientCert::build($commonName, $serialNumber);
        $this->clientCertRepository->add($clientCert);

        return $clientCert;
    }
}