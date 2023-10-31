<?php

namespace App\Repository;

use App\Entity\Gggg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Gggg>
 *
 * @method Gggg|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gggg|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gggg[]    findAll()
 * @method Gggg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GgggRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gggg::class);
    }

//    /**
//     * @return Gggg[] Returns an array of Gggg objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Gggg
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
