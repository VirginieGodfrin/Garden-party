<?php

namespace App\Repository;

use App\Entity\Decomposeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Decomposeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Decomposeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Decomposeur[]    findAll()
 * @method Decomposeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DecomposeurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Decomposeur::class);
    }

    // /**
    //  * @return Decomposeur[] Returns an array of Decomposeur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Decomposeur
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
