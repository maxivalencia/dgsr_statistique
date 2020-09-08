<?php

namespace App\Repository;

use App\Entity\CtAnomalieType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtAnomalieType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtAnomalieType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtAnomalieType[]    findAll()
 * @method CtAnomalieType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtAnomalieTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtAnomalieType::class);
    }

    // /**
    //  * @return CtAnomalieType[] Returns an array of CtAnomalieType objects
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
    public function findOneBySomeField($value): ?CtAnomalieType
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
