<?php

namespace App\Repository;

use App\Entity\Arbre;
use App\Entity\Vegetal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Arbre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Arbre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Arbre[]    findAll()
 * @method Arbre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArbreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Arbre::class);
    }

    public function giveMeAllArbresDQL(): array
    {
        $entityManager = $this->getEntityManager();
        
        $query = $entityManager->createQuery(
            "SELECT a
            FROM App\Entity\Arbre a
            WHERE a INSTANCE OF App\Entity\Vegetal "
        );

        // returns an array of objects
        return $query->execute();
    }

    // /**
    //  * @return Arbre[] Returns an array of Arbre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Arbre
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
