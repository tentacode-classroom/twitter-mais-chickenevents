<?php

namespace App\Repository;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function searchPosts(string $message)
    {
        return $this->createQueryBuilder('m')
            ->where( 'm.message LIKE :message' )
            ->setParameter( 'message', '%'.$message.'%' )
            ->getQuery()
            ->getResult();
    }

    public function getFollowingsPosts(User $user)
    {
        return $this->createQueryBuilder( 'p' )
            ->join( 'p.user', 'u' )
            ->join( 'u.followings', 'f')
            ->join( 'p.userTimeline', 'ut')
            ->join( 'ut.followings', 'utf' )
            ->Where( 'utf = :user' )
            ->orWhere( 'f = :user')
            ->setParameter( 'user', $user )
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return Post[] Returns an array of Post objects
//     */
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
    public function findOneBySomeField($value): ?Post
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
