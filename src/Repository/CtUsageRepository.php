<?php

namespace App\Repository;

use App\Entity\CtUsage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtUsage|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtUsage|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtUsage[]    findAll()
 * @method CtUsage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtUsageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtUsage::class);
    }

    // /**
    //  * @return CtUsage[] Returns an array of CtUsage objects
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
    public function findOneBySomeField($value): ?CtUsage
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
