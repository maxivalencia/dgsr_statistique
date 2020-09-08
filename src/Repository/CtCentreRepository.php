<?php

namespace App\Repository;

use App\Entity\CtCentre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtCentre|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtCentre|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtCentre[]    findAll()
 * @method CtCentre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtCentreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtCentre::class);
    }

    // /**
    //  * @return CtCentre[] Returns an array of CtCentre objects
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
    public function findOneBySomeField($value): ?CtCentre
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
