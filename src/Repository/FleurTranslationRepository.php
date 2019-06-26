<?php

namespace App\Repository;

use App\Entity\FleurTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FleurTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method FleurTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method FleurTranslation[]    findAll()
 * @method FleurTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FleurTranslationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FleurTranslation::class);
    }

    // /**
    //  * @return FleurTranslation[] Returns an array of FleurTranslation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FleurTranslation
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
