<?php

namespace App\Repository;

use App\Entity\CtTypeReception;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtTypeReception|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtTypeReception|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtTypeReception[]    findAll()
 * @method CtTypeReception[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtTypeReceptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtTypeReception::class);
    }

    // /**
    //  * @return CtTypeReception[] Returns an array of CtTypeReception objects
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
    public function findOneBySomeField($value): ?CtTypeReception
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
