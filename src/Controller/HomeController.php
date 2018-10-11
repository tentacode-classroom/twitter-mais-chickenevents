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
        $form = $this->createForm( PostType::class, Post::class);

        return $this->render('home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
