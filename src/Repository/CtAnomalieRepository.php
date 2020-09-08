<?php

namespace App\Repository;

use App\Entity\CtAnomalie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtAnomalie|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtAnomalie|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtAnomalie[]    findAll()
 * @method CtAnomalie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtAnomalieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtAnomalie::class);
    }

    // /**
    //  * @return CtAnomalie[] Returns an array of CtAnomalie objects
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
    public function findOneBySomeField($value): ?CtAnomalie
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
