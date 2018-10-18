<?php

namespace App\Controller\Post;

use App\Entity\Follow;
use App\Entity\Post;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;




class RePostController extends AbstractController
{
    /**
     * @Route("/repost/{postId}", name="re_post")
     */
    public function index(Request $request, UserInterface $user, $postId)
    {
        $manager = $this->getDoctrine()->getManager();

        $post = $this->getDoctrine()->getRepository(Post::class)
            ->find($postId);

        if( in_array( $user, $post->getUserTimeline()->toArray() ) ) {
            $post->removeUserTimeline( $user );
        } else {
            $post->addUserTimeline( $user );
        }

        $manager->persist( $post );
        $manager->flush();

        return $this->redirectToRoute('home');
    }
}
