<?php

namespace App\Repository;

use App\Entity\IpRange;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IpRange>
 *
 * @method IpRange|null find($id, $lockMode = null, $lockVersion = null)
 * @method IpRange|null findOneBy(array $criteria, array $orderBy = null)
 * @method IpRange[]    findAll()
 * @method IpRange[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IpRangeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IpRange::class);
    }

//    /**
//     * @return IpRange[] Returns an array of IpRange objects
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

//    public function findOneBySomeField($value): ?IpRange
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
