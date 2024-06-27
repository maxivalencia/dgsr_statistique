<?php

namespace App\Repository;

use App\Entity\CtArretePrix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtArretePrix|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtArretePrix|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtArretePrix[]    findAll()
 * @method CtArretePrix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtArretePrixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtArretePrix::class);
    }

    // /**
    //  * @return CtArretePrix[] Returns an array of CtAnomalie objects
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
    public function findOneBySomeField($value): ?CtArretePrix
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
