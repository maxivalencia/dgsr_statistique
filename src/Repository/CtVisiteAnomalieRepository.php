<?php

namespace App\Repository;

use App\Entity\CtVisiteAnomalie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtVisiteAnomalie|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtVisiteAnomalie|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtVisiteAnomalie[]    findAll()
 * @method CtVisiteAnomalie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtVisiteAnomalieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtVisiteAnomalie::class);
    }

    // /**
    //  * @return CtVisiteAnomalie[] Returns an array of CtVisiteAnomalie objects
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
    public function findOneBySomeField($value): ?CtVisiteAnomalie
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
