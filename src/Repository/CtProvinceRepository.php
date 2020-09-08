<?php

namespace App\Repository;

use App\Entity\CtProvince;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtProvince|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtProvince|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtProvince[]    findAll()
 * @method CtProvince[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtProvinceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtProvince::class);
    }

    // /**
    //  * @return CtProvince[] Returns an array of CtProvince objects
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
    public function findOneBySomeField($value): ?CtProvince
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
