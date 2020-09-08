<?php

namespace App\Repository;

use App\Entity\CtTypeVisite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtTypeVisite|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtTypeVisite|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtTypeVisite[]    findAll()
 * @method CtTypeVisite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtTypeVisiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtTypeVisite::class);
    }

    // /**
    //  * @return CtTypeVisite[] Returns an array of CtTypeVisite objects
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
    public function findOneBySomeField($value): ?CtTypeVisite
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
