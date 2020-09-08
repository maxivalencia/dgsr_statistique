<?php

namespace App\Repository;

use App\Entity\CtRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtRole[]    findAll()
 * @method CtRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtRoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtRole::class);
    }

    // /**
    //  * @return CtRole[] Returns an array of CtRole objects
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
    public function findOneBySomeField($value): ?CtRole
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
