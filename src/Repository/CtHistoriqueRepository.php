<?php

namespace App\Repository;

use App\Entity\CtHistorique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtHistorique|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtHistorique|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtHistorique[]    findAll()
 * @method CtHistorique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtHistoriqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtHistorique::class);
    }

    // /**
    //  * @return CtHistorique[] Returns an array of CtHistorique objects
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
    public function findOneBySomeField($value): ?CtHistorique
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
