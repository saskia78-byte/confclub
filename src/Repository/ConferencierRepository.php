<?php

namespace App\Repository;

use App\Entity\Conferencier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Conferencier>
 */
class ConferencierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conferencier::class);
    }

    public function findByConference(int $confId): array
    {
        return $this->createQueryBuilder('c')
            ->join('c.confs', 'conf')
            ->where('conf.id = :confId')
            ->setParameter('confId', $confId)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Conferencier[] Returns an array of Conferencier objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Conferencier
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
