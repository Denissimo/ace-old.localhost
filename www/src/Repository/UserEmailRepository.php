<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\UserEmail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\BrowserKit\Request;

/**
 * @extends ServiceEntityRepository<UserEmail>
 *
 * @method UserEmail|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserEmail|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserEmail[]    findAll()
 * @method UserEmail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserEmailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserEmail::class);
    }

    public function save(UserEmail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserEmail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function setMainEmail(UserEmail $userEmail)
    {
        $user = $userEmail->getUser();
        $userEmails = $user->getUserEmails();
        foreach ($userEmails as $email){
            $email->setIsMain(false);
        }
        $userEmail->setIsMain(true);

        $this->getEntityManager()->flush();
    }

//    /**
//     * @return UserEmail[] Returns an array of UserEmail objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserEmail
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
