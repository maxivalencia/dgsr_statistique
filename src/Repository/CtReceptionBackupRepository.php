<?php

namespace App\Repository;

use App\Entity\CtReceptionBackup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtReceptionBackup|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtReceptionBackup|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtReceptionBackup[]    findAll()
 * @method CtReceptionBackup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtReceptionBackupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtReceptionBackup::class);
    }

    // /**
    //  * @return CtReceptionBackup[] Returns an array of CtReceptionBackup objects
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
    public function findOneBySomeField($value): ?CtReceptionBackup
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
