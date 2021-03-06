<?php

namespace App\Repository;

use App\Entity\CtDroitPtac;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtDroitPtac|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtDroitPtac|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtDroitPtac[]    findAll()
 * @method CtDroitPtac[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtDroitPtacRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtDroitPtac::class);
    }

    // /**
    //  * @return CtDroitPtac[] Returns an array of CtDroitPtac objects
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
    public function findOneBySomeField($value): ?CtDroitPtac
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
