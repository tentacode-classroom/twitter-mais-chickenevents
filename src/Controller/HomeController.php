<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $post = new Post();
        $form = $this->createForm( PostType::class, $post );

        return $this->render('pages/home.html.twig', [
            'form'  =>  $form->createView()
        ]);
    }
}
