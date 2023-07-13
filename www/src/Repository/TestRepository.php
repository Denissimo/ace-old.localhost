<?php

namespace App\Repository;

use App\Entity\Test;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use ApiPlatform\Doctrine\Orm\Paginator;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @extends ServiceEntityRepository<Test>
 *
 * @method Test|null find($id, $lockMode = null, $lockVersion = null)
 * @method Test|null findOneBy(array $criteria, array $orderBy = null)
 * @method Test[]    findAll()
 * @method Test[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Test::class);
    }

    public function save(Test $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Test $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function loadTests(int $page = 1): Paginator
    {
        $firstResult = ($page -1) * 10;
        $queryBuilder = $this->createQueryBuilder('t');
        $queryBuilder->select('t')
            ->from(Test::class, 't')
            ->where('t.number > :number')
            ->setParameter('number', 800);
        $query = $queryBuilder->getQuery()
            ->setFirstResult($firstResult)
            ->setMaxResults(10);
        $doctrinePaginator = new DoctrinePaginator($query);

        return new Paginator($doctrinePaginator);
    }


    public function getTests(int $number = 0)
    {
        $queryBuilder = $this->createQueryBuilder('t');
        $queryBuilder
            ->where('t.number > :number')
            ->setParameter('number', $number);
        $query = $queryBuilder->getQuery()
            ->setMaxResults(10);
        $doctrinePaginator = new DoctrinePaginator($query);

        return $doctrinePaginator->getQuery()->getResult();
    }

//    /**
//     * @return Test[] Returns an array of Test objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Test
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
