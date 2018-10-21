<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(UserInterface $user)
    {
        $posts = $this->getDoctrine()->getRepository( Post::class )
            ->getFollowingsPosts( $user );

        return $this->render('pages/home.html.twig', [
            'posts' =>  $posts
        ]);
    }
}
