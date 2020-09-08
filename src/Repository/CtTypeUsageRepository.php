<?php

namespace App\Repository;

use App\Entity\CtTypeUsage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtTypeUsage|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtTypeUsage|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtTypeUsage[]    findAll()
 * @method CtTypeUsage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtTypeUsageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtTypeUsage::class);
    }

    // /**
    //  * @return CtTypeUsage[] Returns an array of CtTypeUsage objects
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
    public function findOneBySomeField($value): ?CtTypeUsage
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
