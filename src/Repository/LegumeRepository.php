<?php

namespace App\Repository;

use App\Entity\Legume;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Legume|null find($id, $lockMode = null, $lockVersion = null)
 * @method Legume|null findOneBy(array $criteria, array $orderBy = null)
 * @method Legume[]    findAll()
 * @method Legume[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LegumeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Legume::class);
    }

    /**
     * @return Legume[] Returns an array of Legume objects
     */

    public function findByfleurNom($fleurNom)
    {
        return $this->createQueryBuilder('l')
            ->join('l.fleurs', 'f')
            ->andWhere('f.nom = :nom')
            ->setParameter('nom', $fleurNom)
            ->getQuery()
            ->getResult()
        ;
    }


    // /**
    //  * @return Legume[] Returns an array of Legume objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Legume
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
