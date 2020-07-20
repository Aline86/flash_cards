<?php

namespace App\Repository;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Russe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ThemeRepository;

/**
 * @method Russe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Russe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Russe[]    findAll()
 * @method Russe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RusseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Russe::class);
    }
    public static function adminQueryBuilderTheme(ThemeRepository $r): QueryBuilder
    {
        return $r->createQueryBuilder('e')
           ->innerJoin('e.titre', 'et')
           ->where('et.titre = :theme')
           ->orderBy('e.id', 'ASC');
     }
   /**
     * @return Russe[] Returns an array of Russe objects
     */
  
    public function findByThemeField($value)
    {  
        return $this->createQueryBuilder('r')
            ->andWhere('r.theme = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneBySomeField($value): ?Russe
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    
 
}
