<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recette>
 *
 * @method Recette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette[]    findAll()
 * @method Recette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recette::class);
    }

    public function save(Recette $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Recette $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // public function queryOkRegime(lstIdRegimes): array
    public function queryOkRegime(int $user_id): array
    {
        $conn = $this->getEntityManager()->getConnection();
    
        $sql = "
        SELECT R.*, 
        FROM recette AS R
        WHERE id in

        (
            SELECT DISTINCT (recette_id) 
            FROM `recette_regime`
            WHERE regime_id IN (                
                    SELECT regime_id 
                    FROM user_regime
                    WHERE user_id = $user_id)
            
            EXCEPT
            
            SELECT DISTINCT (recette_id) 
            FROM `recette_allergene`
            WHERE allergene_id NOT IN (                
                    SELECT allergene_id 
                    FROM user_allergene
                    WHERE user_id = $user_id)
        )

        ORDER BY titre ASC
            ";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        dd($resultSet->fetchAllAssociative());
        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function queryNotes(): array
    {
        $conn = $this->getEntityManager()->getConnection();
    
        $sql = "
        SELECT recette_id,  
        AVG(note),
        COUNT(note)
        FROM note
        ORDER BY 1
        ";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        dd($resultSet->fetchAllAssociative());
        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }





//    /**
//     * @return Recette[] Returns an array of Recette objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Recette
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
