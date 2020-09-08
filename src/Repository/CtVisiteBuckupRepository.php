<?php

namespace App\Repository;

use App\Entity\CtVisiteBuckup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtVisiteBuckup|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtVisiteBuckup|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtVisiteBuckup[]    findAll()
 * @method CtVisiteBuckup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtVisiteBuckupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtVisiteBuckup::class);
    }

    // /**
    //  * @return CtVisiteBuckup[] Returns an array of CtVisiteBuckup objects
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
    public function findOneBySomeField($value): ?CtVisiteBuckup
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
