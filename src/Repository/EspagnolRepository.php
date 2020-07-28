<?php

namespace App\Repository;

use App\Entity\Espagnol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Espagnol|null find($id, $lockMode = null, $lockVersion = null)
 * @method Espagnol|null findOneBy(array $criteria, array $orderBy = null)
 * @method Espagnol[]    findAll()
 * @method Espagnol[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspagnolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Espagnol::class);
    }
    public function findByThemeField($value)
    {  
        return $this->createQueryBuilder('r')
            ->andWhere('r.theme = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    // /**
    //  * @return Espagnol[] Returns an array of Espagnol objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Espagnol
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
