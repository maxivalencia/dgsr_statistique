<?php

namespace App\Repository;

use App\Entity\CtConstAvDedCarac;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtConstAvDedCarac|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtConstAvDedCarac|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtConstAvDedCarac[]    findAll()
 * @method CtConstAvDedCarac[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtAvDedCaracRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtConstAvDedCarac::class);
    }

    // /**
    //  * @return CtConstAvDedCarac[] Returns an array of CtConstAvDedCarac objects
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
    public function findOneBySomeField($value): ?CtConstAvDedCarac
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
