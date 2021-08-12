<?php

namespace App\Repository;

use App\Entity\WallMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WallMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method WallMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method WallMessage[]    findAll()
 * @method WallMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WallMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WallMessage::class);
    }

    // /**
    //  * @return WallMessage[] Returns an array of WallMessage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WallMessage
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
