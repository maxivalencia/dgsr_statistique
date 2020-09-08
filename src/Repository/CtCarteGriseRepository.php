<?php

namespace App\Repository;

use App\Entity\CtCarteGrise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtCarteGrise|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtCarteGrise|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtCarteGrise[]    findAll()
 * @method CtCarteGrise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtCarteGriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtCarteGrise::class);
    }

    // /**
    //  * @return CtCarteGrise[] Returns an array of CtCarteGrise objects
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
    public function findOneBySomeField($value): ?CtCarteGrise
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
