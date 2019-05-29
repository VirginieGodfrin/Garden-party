<?php

namespace App\Repository;

use App\Entity\Pollinisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Pollinisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pollinisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pollinisateur[]    findAll()
 * @method Pollinisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PollinisateurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pollinisateur::class);
    }

    // /**
    //  * @return Pollinisateur[] Returns an array of Pollinisateur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pollinisateur
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
