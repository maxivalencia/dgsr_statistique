<?php

namespace App\Repository;

use App\Entity\CtDroitPtacBackup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtDroitPtacBackup|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtDroitPtacBackup|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtDroitPtacBackup[]    findAll()
 * @method CtDroitPtacBackup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtDroitPtacBackupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtDroitPtacBackup::class);
    }

    // /**
    //  * @return CtDroitPtacBackup[] Returns an array of CtDroitPtacBackup objects
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
    public function findOneBySomeField($value): ?CtDroitPtacBackup
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
