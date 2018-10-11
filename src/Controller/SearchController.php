<?php

namespace App\Controller;

use App\Entity\Post;
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
        $paramMessage = $request->get( 'q' );

        $messages = $this->getDoctrine()->getRepository( Post::class )
            ->findByString( $paramMessage );
        dump($messages);

        return $this->render('search.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }
}
