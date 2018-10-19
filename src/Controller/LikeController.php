<?php

namespace App\Controller;


use App\Entity\Post;
use App\Entity\Like;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;


class LikeController extends AbstractController
{
    /**
     * @Route("/like/{postId}", name="like")
     */
    public function like($postId, UserInterface $user)
    {
        $manager = $this->getDoctrine()->getManager();

        $like = $this->getDoctrine()->getRepository(Like::class)
            ->findOneLike($user->getId(), $postId);

        $liker = $user;

        $post = $this->getDoctrine()->getRepository( Post::class )
            ->find( $postId );

        if (count($like) < 1) {
            $newLike = new Like();
            $newLike->setPost( $post );
            $newLike->setLiker( $liker );

            $manager->persist($newLike);
            $manager->flush();
            return new Response('Like', 200 );
        } else {
            $manager->remove( $like[0] );
            $manager->flush();
            return new Response('UnLike', 200 );
        }

    }

}
