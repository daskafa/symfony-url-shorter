<?php

namespace App\Repository;

use App\Entity\HomepageInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HomepageInterface|null find($id, $lockMode = null, $lockVersion = null)
 * @method HomepageInterface|null findOneBy(array $criteria, array $orderBy = null)
 * @method HomepageInterface[]    findAll()
 * @method HomepageInterface[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HomepageInterfaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HomepageInterface::class);
    }

    // /**
    //  * @return HomepageInterface[] Returns an array of HomepageInterface objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HomepageInterface
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
