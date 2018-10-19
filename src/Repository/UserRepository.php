<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function searchUsers(string $search)
    {
        return $this->createQueryBuilder('u')
            ->where( 'u.firstname LIKE :searchLike' )
            ->orWhere( 'u.lastname LIKE :searchLike' )
            ->orWhere( 'u.email = :search' )
            ->orWhere( 'u.pseudo = :search' )
            ->setParameter( 'searchLike', '%'.$search.'%' )
            ->setParameter( 'search', $search )
            ->getQuery()
            ->getResult();
    }

    public function getUserByUserName(string $username)
    {
        return $this->createQueryBuilder('u')
            ->where( 'u.pseudo = :username' )
            ->setParameter( 'username', $username )
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return Auth[] Returns an array of Auth objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Auth
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
