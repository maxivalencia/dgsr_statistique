<?php

namespace App\Repository;

use App\Entity\CtVisite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtVisite|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtVisite|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtVisite[]    findAll()
 * @method CtVisite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtVisiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtVisite::class);
    }

    // /**
    //  * @return CtVisite[] Returns an array of CtVisite objects
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
    public function findOneBySomeField($value): ?CtVisite
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
