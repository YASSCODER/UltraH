<?php

namespace App\Repository;

use App\Entity\Ingrediant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ingrediant>
 *
 * @method Ingrediant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ingrediant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ingrediant[]    findAll()
 * @method Ingrediant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngrediantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ingrediant::class);
    }

    public function save(Ingrediant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);
        
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Ingrediant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    
    public function searchByTitre($searchQuery)
    {
        return $this->createQueryBuilder('i')
            ->where('i.titre LIKE :query')
            ->setParameter('query', '%'.$searchQuery.'%')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Ingrediant[] Returns an array of Ingrediant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ingrediant
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

}