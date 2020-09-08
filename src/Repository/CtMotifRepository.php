<?php

namespace App\Repository;

use App\Entity\CtMotif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtMotif|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtMotif|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtMotif[]    findAll()
 * @method CtMotif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtMotifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtMotif::class);
    }

    // /**
    //  * @return CtMotif[] Returns an array of CtMotif objects
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
    public function findOneBySomeField($value): ?CtMotif
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
