<?php

namespace App\Repository;

use App\Entity\CtDroitPtacBak;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtDroitPtacBak|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtDroitPtacBak|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtDroitPtacBak[]    findAll()
 * @method CtDroitPtacBak[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtDroitPtacBakRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtDroitPtacBak::class);
    }

    // /**
    //  * @return CtDroitPtacBak[] Returns an array of CtDroitPtacBak objects
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
    public function findOneBySomeField($value): ?CtDroitPtacBak
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
