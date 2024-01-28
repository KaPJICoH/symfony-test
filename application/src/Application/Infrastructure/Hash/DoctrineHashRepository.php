<?php

namespace App\Application\Infrastructure\Hash;

use App\Application\Domain\Hash\Model\Hash;
use App\Application\Domain\Hash\Repository\HashRepository;
use App\Framework\Domain\Exception\ResourceNotFound;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Hash>
 *
 * @method Hash|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hash|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hash[]    findAll()
 * @method Hash[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineHashRepository extends ServiceEntityRepository implements HashRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hash::class);
    }

    public function save(Hash $user): void
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * @throws ResourceNotFound
     */
    public function getOneBy(array $criteria, array $orderBy = null): Hash
    {
        $hash = $this->findOneBy($criteria, $orderBy);
        if (!$hash) {
            throw new ResourceNotFound();
        }

        return $hash;
    }

    public function findCollisions(Hash $hash): array
    {
        return $this->createQueryBuilder('h')
            ->where('h.result = :result')
            ->setParameter('result', $hash->getResult())
            ->andWhere('h.algorithm = :algorithm')
            ->setParameter('algorithm', $hash->getAlgorithm())
            ->andWhere('h.id != :hashId')
            ->setParameter('hashId', $hash->getId())
            ->getQuery()
            ->getResult();
    }

    public function isHaveCollision(Hash $hash): bool
    {
        return (bool)$this->createQueryBuilder('h')
            ->select('COUNT(h.id)')
            ->where('h.result = :result')
            ->setParameter('result', $hash->getResult())
            ->andWhere('h.algorithm = :algorithm')
            ->setParameter('algorithm', $hash->getAlgorithm())
            ->andWhere('h.id != :hashId')
            ->setParameter('hashId', $hash->getId())
            ->getQuery()
            ->getSingleScalarResult();
    }
}
