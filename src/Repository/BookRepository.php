<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }
    public function searchBookByRef($ref)
    {
        return $this->createQueryBuilder('b')
            ->where('b.ref = :ref')
            ->setParameter('ref', $ref)
            ->getQuery()
            ->getOneOrNullResult(); 
    }
    public function booksListByAuthors()
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.author', 'a') // Jointure avec la relation "author" de Book
            ->addSelect('a') // Sélection de l'entité Author
            ->orderBy('a.name', 'ASC') // Tri par nom d'auteur en ordre ascendant
            ->getQuery()
            ->getResult();
    }
    public function findBooksBeforeYearWithAuthors()
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.author', 'a') // Jointure avec l'entité Author
            ->where('b.publicationYear < :year')
            ->andWhere('a.id IN (
                SELECT aa.id
                FROM App\Entity\Author aa
                INNER JOIN App\Entity\Book ab ON aa.id = ab.author
                GROUP BY aa.id
                HAVING COUNT(ab.id) > 10
            )')
            ->setParameter('year', 2023)
            ->getQuery()
            ->getResult();
    }
    public function findScienceFictionBooks()
    {
        return $this->createQueryBuilder('b')
            ->where('b.category = :category')
            ->setParameter('category', 'Science-Fiction')
            ->getQuery()
            ->getResult();
    }
    
    public function findBooksBetweenDates($startDate, $endDate)
    {
        return $this->createQueryBuilder('b')
            ->where('b.publicationDate >= :startDate')
            ->andWhere('b.publicationDate <= :endDate')
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Book[] Returns an array of Book objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Book
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
