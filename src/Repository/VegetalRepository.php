<?php

namespace App\Repository;

use App\Entity\Vegetal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Vegetal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vegetal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vegetal[]    findAll()
 * @method Vegetal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VegetalRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Vegetal::class);
    }

    // /**
    //  * @return Vegetal[] Returns an array of Vegetal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vegetal
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
