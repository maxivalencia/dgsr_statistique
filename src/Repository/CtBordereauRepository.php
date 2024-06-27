<?php

namespace App\Repository;

use App\Entity\CtBordereau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtBordereau|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtBordereau|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtBordereau[]    findAll()
 * @method CtBordereau[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtBordereauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtBordereau::class);
    }

    // /**
    //  * @return CtBordereau[] Returns an array of CtAnomalie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CtBordereau
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
