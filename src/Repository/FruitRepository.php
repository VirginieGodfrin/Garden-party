<?php

namespace App\Repository;

use App\Entity\Fruit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * @method Fruit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fruit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fruit[]    findAll()
 * @method Fruit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FruitRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Fruit::class);
    }

    /**
     * @return Fruit[] Returns an array of Fruit objects
     */
    public function giveMeAllFruit()
    {
        return $this->createQueryBuilder('f')
            ->join('f.arbre', 'a')
            ->addSelect('a')
            ->join('f.mangeur', 'm')
            ->addSelect('m')
            ->leftJoin('f.jardiniers', 'j')
            ->addSelect('j')
            ->orderBy('f.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function giveMeAllArbresDQL(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT a, f, aj
            FROM App\Entity\Arbre a
            LEFT JOIN a.fruits f
            LEFT JOIN a.jardiniers aj"
         );
        // returns an array of objects
        return $query->execute();
    }

    public function giveMeAllArbresWithFruitsDQL(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT a, f, aj
            FROM App\Entity\Arbre a
            JOIN a.fruits f
            LEFT JOIN a.jardiniers aj"
         );
        // returns an array of objects
        return $query->execute();
    }

    // /**
    //  * @return Fruit[] Returns an array of Fruit objects
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
    public function findOneBySomeField($value): ?Fruit
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
