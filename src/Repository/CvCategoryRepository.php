<?php

namespace App\Repository;

use App\Entity\CvCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CvCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CvCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CvCategory[]    findAll()
 * @method CvCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CvCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CvCategory::class);
    }

    // /**
    //  * @return CvCategory[] Returns an array of CvCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CvCategory
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
