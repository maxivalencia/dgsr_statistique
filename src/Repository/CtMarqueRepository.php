<?php

namespace App\Repository;

use App\Entity\CtMarque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtMarque|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtMarque|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtMarque[]    findAll()
 * @method CtMarque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtMarqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtMarque::class);
    }

    // /**
    //  * @return CtMarque[] Returns an array of CtMarque objects
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
    public function findOneBySomeField($value): ?CtMarque
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
