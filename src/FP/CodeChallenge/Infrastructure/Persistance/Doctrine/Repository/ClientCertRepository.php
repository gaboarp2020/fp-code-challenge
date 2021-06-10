<?php

namespace App\Infrastructure\Persistance\Doctrine\Repository;
use App\Domain\Model\ClientCert;
use App\Domain\Model\Repository\ClientCertRepositoryInterface;
use App\Domain\ValueObject\SerialNumber;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;

use function assert;

final class ClientCertRepository implements ClientCertRepositoryInterface
{
    private $entityManger;

    public function __construct(EntityManager $em)
    {
        $this->entityManger = $em;
    }

    public function add(ClientCert $clientCert): void
    {
        $this->entityManger->persist($clientCert);
        $this->entityManger->flush();
    }
    
    public function findBySerialNumber(SerialNumber $serialNumber): ?ClientCert
    {
        $queryBuilder = $this->entityManger->createQueryBuilder();
        $queryBuilder
            ->select('clientCerts')
            ->from(ClientCert::class, 'clientCerts')
            ->where('clientCerts.serialNumber = :serial_number')
            ->setParameter(':serial_number', $serialNumber->value());

        $query = $queryBuilder->getQuery();

        try {
            $clientCert = $query->getSingleResult();
            assert($clientCert instanceof ClientCert);
            return $clientCert;
        } catch (NoResultException $e) {
            return null;
        }
    }

    public function delete(ClientCert $clientCert): void
    {
        $this->entityManger->remove($clientCert);
        $this->entityManger->flush();
    }
}