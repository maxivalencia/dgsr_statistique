<?php

namespace App\Repository;

use App\Entity\CtOptionVitreFumee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtOptionVitreFumee|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtOptionVitreFumee|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtOptionVitreFumee[]    findAll()
 * @method CtOptionVitreFumee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtOptionVitreFumeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtOptionVitreFumee::class);
    }

    // /**
    //  * @return CtOptionVitreFumee[] Returns an array of CtAnomalie objects
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
    public function findOneBySomeField($value): ?CtOptionVitreFumee
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
