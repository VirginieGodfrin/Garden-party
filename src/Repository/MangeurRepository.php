<?php

namespace App\Repository;

use App\Entity\Mangeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Mangeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mangeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mangeur[]    findAll()
 * @method Mangeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MangeurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Mangeur::class);
    }

    /**
     * @return Mangeur[] Returns an array of Mangeur objects
     */
    
    public function giveMeAllMangeurs()
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.fruits', 'f')
            ->addSelect('f')
            ->orderBy('m.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    
    // /**
    //  * @return Mangeur[] Returns an array of Mangeur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mangeur
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
