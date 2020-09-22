<?php

namespace App\Repository;

use App\Entity\CtConstAvDedsConstAvDedCaracs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtConstAvDedsConstAvDedCaracs|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtConstAvDedsConstAvDedCaracs|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtConstAvDedsConstAvDedCaracs[]    findAll()
 * @method CtConstAvDedsConstAvDedCaracs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtConstAvDedsConstAvDedCaracsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtConstAvDedsConstAvDedCaracs::class);
    }

    // /**
    //  * @return CtConstAvDedsConstAvDedCaracs[] Returns an array of CtConstAvDedsConstAvDedCaracs objects
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
    public function findOneBySomeField($value): ?CtConstAvDedsConstAvDedCaracs
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
