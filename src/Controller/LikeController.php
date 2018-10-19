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


        if ($action === 'like' && !in_array( $user, $post->getLikes()->toArray()) ) {
            $post->addLike( $user );

            $manager->persist($post);
            $manager->flush();
            return new Response('Like', 200 );

        } else if ( $action === 'unlike' && in_array( $user, $post->getLikes()->toArray()) ) {
            $post->removeLike( $user );

            $manager->persist($post);
            $manager->flush();
            return new Response('UnLike', 200 );
        } else {
            return new Response('error', 400);
        }

    }

}
