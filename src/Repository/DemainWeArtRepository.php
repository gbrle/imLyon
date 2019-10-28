<?php

namespace App\Repository;

use App\Entity\DemainWeArt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DemainWeArt|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemainWeArt|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemainWeArt[]    findAll()
 * @method DemainWeArt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemainWeArtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemainWeArt::class);
    }

    // /**
    //  * @return DemainWeArt[] Returns an array of DemainWeArt objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DemainWeArt
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
