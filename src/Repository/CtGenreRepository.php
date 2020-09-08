<?php

namespace App\Repository;

use App\Entity\CtGenre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtGenre|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtGenre|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtGenre[]    findAll()
 * @method CtGenre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtGenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtGenre::class);
    }

    // /**
    //  * @return CtGenre[] Returns an array of CtGenre objects
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
    public function findOneBySomeField($value): ?CtGenre
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
