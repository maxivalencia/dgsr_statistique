<?php

namespace App\Repository;

use App\Entity\CtPlaqueChassis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtPlaqueChassis|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtPlaqueChassis|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtPlaqueChassis[]    findAll()
 * @method CtPlaqueChassis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtPlaqueChassisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtPlaqueChassis::class);
    }

    // /**
    //  * @return CtPlaqueChassis[] Returns an array of CtAnomalie objects
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
    public function findOneBySomeField($value): ?CtPlaqueChassis
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
