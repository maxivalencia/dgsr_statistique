<?php

namespace App\Repository;

use App\Entity\CtUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtUser[]    findAll()
 * @method CtUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtUser::class);
    }

    // /**
    //  * @return CtUser[] Returns an array of CtUser objects
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
    public function findOneBySomeField($value): ?CtUser
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
     * @return User[] Returns an array of User objects
     */
    public function rechercher($value)
    {
        $values= $value;
        $centre = strtoupper($values);
        //$centre = $value;
        
        return $this->createQueryBuilder('p') 
            ->Where('p.username LIKE :val')
            ->orWhere('p.usrName LIKE :val')
            //->orWhere('p.ctCentre LIKE :val')
            ->setParameter('val', '%'.$values.'%')
            //->setParameter('ct', '%'.$centre.'%')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
}
