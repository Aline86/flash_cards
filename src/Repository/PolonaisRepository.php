<?php

namespace App\Repository;

use App\Entity\Polonais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Polonais|null find($id, $lockMode = null, $lockVersion = null)
 * @method Polonais|null findOneBy(array $criteria, array $orderBy = null)
 * @method Polonais[]    findAll()
 * @method Polonais[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PolonaisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Polonais::class);
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

    /**
     * @return Polonais[] Returns an array of Polonais objects
     */
  
    public function findByFrenchFields($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.fr LIKE :val')
            ->setParameter('val', $value.'%')
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findByPolonaisFields($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.pl LIKE :val')
            ->setParameter('val', $value.'%')
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Polonais
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
