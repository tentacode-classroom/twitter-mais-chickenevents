<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SingleUserController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="single_user")
     */
    public function index( $username = null )
    {
        if ( !isset($username) ) {
            return $this->render('pages/single-user.html.twig', [
                'user'  =>  false
            ]);
        }

        $user = $this->getDoctrine()->getRepository( User::class )->getUserByUserName( $username );
        return $this->render('pages/single-user.html.twig', [
            'user'  =>  $user
        ]);
    }
}
