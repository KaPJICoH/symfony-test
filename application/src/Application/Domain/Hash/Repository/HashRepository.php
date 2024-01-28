<?php


declare(strict_types=1);

namespace App\Application\Domain\Hash\Repository;

use App\Application\Domain\Hash\Model\Hash;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Hash>
 *
 * @method Hash|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hash|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hash[]    findAll()
 * @method Hash[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface HashRepository
{
    public function save(Hash $user): void;
}
