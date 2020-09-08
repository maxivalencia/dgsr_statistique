<?php

namespace App\Repository;

use App\Entity\CtGenreTarif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtGenreTarif|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtGenreTarif|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtGenreTarif[]    findAll()
 * @method CtGenreTarif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtGenreTarifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtGenreTarif::class);
    }

    // /**
    //  * @return CtGenreTarif[] Returns an array of CtGenreTarif objects
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
    public function findOneBySomeField($value): ?CtGenreTarif
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
