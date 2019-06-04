<?php

namespace App\Repository;

use App\Entity\Fleur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Fleur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fleur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fleur[]    findAll()
 * @method Fleur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FleurRepository extends ServiceEntityRepository
{
    protected $vegetalRepo;

    public function __construct(RegistryInterface $registry, VegetalRepository $vegetalRepo)
    {
        parent::__construct($registry, Fleur::class);

        $this->vegetalRepo = $vegetalRepo;
    }

    /**
     * @return Fleur[] Returns an array of Fleur objects
     */
    
    public function giveMeAllFlowers()
    {
        return $this->createQueryBuilder('f')
            ->InnerJoin('f.mangeur', 'm')
            ->addSelect('m')
            ->InnerJoin('f.jardiniers', 'j')
            ->addSelect('j')
            ->orderBy('f.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    

    // /**
    //  * @return Fleur[] Returns an array of Fleur objects
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
    public function findOneBySomeField($value): ?Fleur
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
