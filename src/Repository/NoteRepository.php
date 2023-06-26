<?php

namespace App\Repository;

use App\Entity\Note;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Note>
 *
 * @method Note|null find($id, $lockMode = null, $lockVersion = null)
 * @method Note|null findOneBy(array $criteria, array $orderBy = null)
 * @method Note[]    findAll()
 * @method Note[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Note::class);
    }

    public function save(Note $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Note $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function queryLstNotes(): array
    {
        $conn = $this->getEntityManager()->getConnection();
    
        $sql = '
            SELECT  
            recette_id,
            COUNT(note) AS nbnote,
            ROUND(AVG(note), 1) AS moynote
            FROM note
            GROUP BY 1
            ORDER BY 1 ASC
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
    
        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function queryLstComment($recette_Id): array
    {
        $conn = $this->getEntityManager()->getConnection();
    
        $sql = "
            SELECT *
            FROM note
            WHERE recette_id = $recette_Id
            ORDER BY date_avis DESC
            ";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
    
        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }




//    /**
//     * @return Note[] Returns an array of Note objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Note
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
