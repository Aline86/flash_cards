<?php

namespace App\Repository;

use App\Entity\Allemand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Allemand|null find($id, $lockMode = null, $lockVersion = null)
 * @method Allemand|null findOneBy(array $criteria, array $orderBy = null)
 * @method Allemand[]    findAll()
 * @method Allemand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AllemandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Allemand::class);
    }

    // /**
    //  * @return Allemand[] Returns an array of Allemand objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Allemand
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
