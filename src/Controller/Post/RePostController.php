<?php

namespace App\Controller\Post;


use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;



class RePostController extends AbstractController
{
    /**
     * @Route("/", name="re_post")
     */
    public function index(Request $request, UserInterface $user)
    {

        $post = new Post();

        if($post->isSubmit()){
            $post->setUser( $user );
            $post->addUserTimeline( $user );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
        }

        return $this->render('components/RePost.html.twig', [
            '' => '',
        ]);
    }
}
