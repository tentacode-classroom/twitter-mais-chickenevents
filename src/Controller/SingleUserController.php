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
    public function index( $id = null )
    {
        if ( !isset($id) ) {
            return $this->render('pages/single-user.html.twig', [
                'user'  =>  false
            ]);
        }

        $user = $this->getDoctrine()->getRepository( User::class )->findOneBy([ 'id' => $id ]);
        return $this->render('pages/single-user.html.twig', [
            'user'  =>  $user
        ]);
    }
}
