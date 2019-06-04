<?php

namespace App\Repository;

use App\Entity\Jardinier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Jardinier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jardinier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jardinier[]    findAll()
 * @method Jardinier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JardinierRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Jardinier::class);
    }

    /**
     * @return Jardinier[] Returns an array of Jardinier objects
     */
    public function giveMeAllJardinier()
    {
        return $this->createQueryBuilder('j')
            ->innerJoin('j.vegetals', 'v')
            ->addSelect('v')
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Jardinier[] Returns an array of Jardinier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Jardinier
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
