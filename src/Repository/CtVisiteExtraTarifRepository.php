<?php

namespace App\Repository;

use App\Entity\CtVisiteExtraTarif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtVisiteExtraTarif|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtVisiteExtraTarif|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtVisiteExtraTarif[]    findAll()
 * @method CtVisiteExtraTarif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtVisiteExtraTarifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtVisiteExtraTarif::class);
    }

    // /**
    //  * @return CtVisiteExtraTarif[] Returns an array of CtVisiteExtraTarif objects
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
    public function findOneBySomeField($value): ?CtVisiteExtraTarif
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
