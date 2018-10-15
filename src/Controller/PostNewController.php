<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostNewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostNewController extends AbstractController
{
    /**
     * @Route("/post/new", name="post_new")
     */
    public function index()
    {
        $post = new Post();
        $form = $this->createForm( PostNewType::class, $post );



        return $this->render('components/post-new-form.html.twig', [
            'form'  =>  $form->createView()
        ]);
    }
}
