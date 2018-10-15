<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index( Request $request )
    {
        $search = $request->get( 'q' );

        $posts = $this->getDoctrine()->getRepository( Post::class )
            ->searchPosts( $search );

        $users = $this->getDoctrine()->getRepository( User::class )
            ->searchUsers( $search );

        return $this->render('pages/search.html.twig', [
            'search_posts'   =>  $posts,
            'search_users'      =>  $users,
            'current_search'            =>  $search
        ]);
    }
}
