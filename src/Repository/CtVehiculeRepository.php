<?php

namespace App\Repository;

use App\Entity\CtVehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtVehicule|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtVehicule|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtVehicule[]    findAll()
 * @method CtVehicule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtVehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtVehicule::class);
    }

    // /**
    //  * @return CtVehicule[] Returns an array of CtVehicule objects
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
    public function findOneBySomeField($value): ?CtVehicule
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return CtVehicule[] Returns an array of CtVehicule objects
     */
    
    public function findLike($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.vhcNumSerie LIKE :val')
            ->setParameter('val', '%'.$value.'%')
            ->orderBy('c.id', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
   
}
