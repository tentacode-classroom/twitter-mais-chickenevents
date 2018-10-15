<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostNewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class PostNewController extends AbstractController
{
    /**
     * @Route("/post/new", name="post_new")
     */
    public function index(Request $request, UserInterface $user)
    {
        $post = new Post();
        $form = $this->createForm( PostNewType::class, $post );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();

            $post->setUser( $user );
            $post->addUserTimeline( $user );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('components/post-new-form.html.twig', [
            'form'  =>  $form->createView()
        ]);
    }
}
