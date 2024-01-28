<?php

namespace App\Application\Infrastructure\Hash;

use App\Application\Domain\Hash\Model\Hash;
use App\Application\Domain\Hash\Repository\HashRepository;
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
}
