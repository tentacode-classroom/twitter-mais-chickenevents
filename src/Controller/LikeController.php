<?php

namespace App\Controller;


use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;


class LikeController extends AbstractController
{
    /**
     * @Route("/like/{postId}", name="like")
     */
    public function like($postId, UserInterface $user, Request $request)
    {
        $action = $request->get('action');
        $manager = $this->getDoctrine()->getManager();

        $post = $this->getDoctrine()->getRepository(Post::class)
            ->find($postId);

        dump($post->getLikes);

//        if ($action === 'like' && !isset($like)) {
//
//
//            $liker = $user;
//            $post = $this->getDoctrine()->getRepository( Post::class )
//            ->find( $postId );
//
//            $newLike = new Like();
//            $newLike->setPost( $post );
//            $newLike->setLiker( $liker );
//
//            $manager->persist($newLike);
//            $manager->flush();
//            return new Response('Like', 200 );
//        } else if ( $action === 'unlike' && isset($like) ) {
//            $manager->remove( $like );
//            $manager->flush();
//            return new Response('UnLike', 200 );
//        } else {
//            return new Response('error', 400);
//        }

    }

}
