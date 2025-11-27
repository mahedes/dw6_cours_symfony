<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    //    /**
    //     * @return Product[] Returns an array of Product objects
    //     */

    // Sélectionner tout ce qui a un prix plus grand que $value
    public function findAllGreaterThanPrice($value): array
    {
        return $this->createQueryBuilder('p') // on crée un query builder dans p (la table product)
            ->andWhere('p.price >= :val') // on fait un WHERE price >= $value
            ->setParameter('val', $value) // $value est mappé sur :val comme paramètre
            ->orderBy('p.id', 'ASC') // ORDER BY id ASC
            ->setMaxResults(10) // LIMIT 10
            ->getQuery() // on execute
            ->getResult() // on retourne le resultat sous forme objet/tableau
        ;
    }

    //    public function findOneBySomeField($value): ?Product
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
