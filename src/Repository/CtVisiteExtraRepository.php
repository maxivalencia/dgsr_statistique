<?php

namespace App\Repository;

use App\Entity\CtVisiteExtra;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtVisiteExtra|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtVisiteExtra|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtVisiteExtra[]    findAll()
 * @method CtVisiteExtra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtVisiteExtraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtVisiteExtra::class);
    }

    // /**
    //  * @return CtVisiteExtra[] Returns an array of CtVisiteExtra objects
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
    public function findOneBySomeField($value): ?CtVisiteExtra
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
