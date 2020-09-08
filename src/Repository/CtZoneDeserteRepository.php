<?php

namespace App\Repository;

use App\Entity\CtZoneDeserte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtZoneDeserte|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtZoneDeserte|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtZoneDeserte[]    findAll()
 * @method CtZoneDeserte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtZoneDeserteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtZoneDeserte::class);
    }

    // /**
    //  * @return CtZoneDeserte[] Returns an array of CtZoneDeserte objects
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
    public function findOneBySomeField($value): ?CtZoneDeserte
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
