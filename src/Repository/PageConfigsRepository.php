<?php

namespace App\Repository;

use App\Entity\PageConfigs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PageConfigs|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageConfigs|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageConfigs[]    findAll()
 * @method PageConfigs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageConfigsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageConfigs::class);
    }

    // /**
    //  * @return PageConfigs[] Returns an array of PageConfigs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PageConfigs
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
